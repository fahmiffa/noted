<?php

namespace App\Http\Controllers;

use App\Models\Formulir;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Content;
use Auth;
use Alert;
use PDF;
use QrCode;
use App\Models\Village;
use App\Models\District;

class FormulirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {                
        $data ='Data Formulir';
        $da = Formulir::all();
        return view('formulir.index',compact('data','da'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $last = Formulir::latest()->first();         
        $nomor = '600.1.15/'.nomor($last);
        $da = Form::findOrFail(1);  
        $dis = District::all();
        $data ='Tambah Data Formulir';     
        return view('formulir.create',compact('data','da','nomor','dis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $rule = [            
            'tanggal' => 'required',
            'noreg' => 'required',                 
            'pengajuan' => 'required',                    
            'namaPemohon' => 'required',                    
            'hp' => 'required',       
            'alamatPemohon'=> 'required', 
            'namaBangunan'=> 'required',       
            'fungsi'=>'required',             
            'alamatBangunan'=>'required',
            'village'=>'required',
            ];

        $message = [            
            'tanggal.required'=>'Field harus diisi',
            'noreg.required'=>'Field harus diisi',        
            'pengajuan.required'=>'Field harus diisi',       
            'namaPemohon.required'=>'Field harus diisi',       
            'hp.required'=>'Field harus diisi',          
            'fungsi.required'=>'Field harus diisi',          
            'alamatPemohon.required'=>'Field harus diisi',          
            'namaBangunan.required'=>'Field harus diisi',    
            'alamatBangunan.required'=>'Field harus diisi',  
            'village.required'=>'Field harus diisi',                          
        ];  


        if($request->tipe == 'doc')
        {
            $rule = array_merge($rule,['file' => 'required|mimes:pdf|max:2048']);
            $message = array_merge($message,[
                'file.required'=>'File harus diisi',       
                'file.mimes'=>'File type invalid',            
                'file.max'=>'File size max 2Mb',    
            ]);
        }
    
        $request->validate($rule,$message);

            $last = Formulir::latest()->first();                 
            $nomor = '600.1.15/'.nomor($last).'/SPm-SIMBG/'.numberToRoman(date('m')).'/'.date('Y');
            $da = [
                'no'=> $nomor,
                'header'=>[$request->noreg, $request->pengajuan, $request->namaPemohon, $request->hp, $request->alamatPemohon, $request->namaBangunan, $request->fungsi, $request->alamatBangunan],                
                'items'=>$request->item,
                'sub'=>$request->sub,
                'saranItem'=>$request->saranItem,
                'saranSub'=>$request->saranSub,
                'saran'=>$request->saran,
                'nameOther'=>$request->nameOther,
                'other'=>$request->other,
                'saranOther'=>$request->saranOther,
            ];
                        
            $form = new Formulir;            
            $form->nomor = $nomor;
            $form->users_id = Auth::user()->id;
            $form->forms_id = 1;
            
            $form->tanggal = $request->tanggal;            
            $form->noreg = $request->noreg;            
            $form->tipe = $request->tipe;            
            $form->status = $request->status;
            $form->villages_id = $request->village;

            if($request->tipe == 'doc')
            {
                $pile = $request->file('file');               
                $piles = 'pile_'.time().'.'.$pile->getClientOriginalExtension();
                $destinationPath = public_path('assets/doc');
                $pile->move($destinationPath, $piles);
                $form->dokumen = $piles;
            }        
            $form->items = json_encode($da);
            
            $form->save();

            return redirect()->route('formulir.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Formulir  $formulir
     * @return \Illuminate\Http\Response
     */
    public function show(Formulir $formulir)
    {        
        $form = Form::findOrFail(1);  
        $item = json_decode($formulir->items);
        // dd($item);
        $header = $item->header;      
        $saran = $item->saran;        
        $res = base64_encode($header[0].'&'.$formulir->nomor);
        $uri = route('qr',['val'=>$res]);                                        
        $qrCode = base64_encode(QrCode::format('png')->size(150)->generate($uri));
        $data = compact('formulir','form','qrCode','saran','item');
        $pdf = PDF::loadView('pdf', $data)->setPaper('a4', 'potrait');    
        return $pdf->stream();

        // return view('pdf',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Formulir  $formulir
     * @return \Illuminate\Http\Response
     */
    public function edit(Formulir $formulir)
    {
        $nomor = $formulir->nomor;
        $da = Form::findOrFail(1);  
        $dis = District::all();
        $data ='Edit Data Formulir';     
        return view('formulir.create',compact('data','da','nomor','dis','formulir'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formulir  $formulir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formulir $formulir)
    {
        $rule = [            
            'tanggal' => 'required',
            'noreg' => 'required',                 
            'pengajuan' => 'required',                    
            'namaPemohon' => 'required',                    
            'hp' => 'required',       
            'alamatPemohon'=> 'required', 
            'namaBangunan'=> 'required',       
            'fungsi'=>'required',             
            'alamatBangunan'=>'required',
            'village'=>'required'
            ];

        $message = [            
            'tanggal.required'=>'Field harus diisi',
            'noreg.required'=>'Field harus diisi',        
            'pengajuan.required'=>'Field harus diisi',       
            'namaPemohon.required'=>'Field harus diisi',       
            'hp.required'=>'Field harus diisi',          
            'fungsi.required'=>'Field harus diisi',          
            'alamatPemohon.required'=>'Field harus diisi',          
            'namaBangunan.required'=>'Field harus diisi',    
            'alamatBangunan.required'=>'Field harus diisi',   
            'village.required'=>'Field harus diisi',                        
        ];  


        if($request->tipe == 'doc' && $request->hasFile('file'))
        {
            $rule = array_merge($rule,['file' => 'mimes:pdf|max:2048']);
            $message = array_merge($message,[                  
                'file.mimes'=>'File type invalid',            
                'file.max'=>'File size max 2Mb',    
            ]);
        }
    
        $request->validate($rule,$message);

            $nomor = $formulir->nomor;
            $da = [
                'no'=> $nomor,
                'header'=>[$request->noreg, $request->pengajuan, $request->namaPemohon, $request->hp, $request->alamatPemohon, $request->namaBangunan, $request->fungsi, $request->alamatBangunan],                
                'items'=>$request->item,
                'sub'=>$request->sub,
                'saranItem'=>$request->saranItem,
                'saranSub'=>$request->saranSub,
                'saran'=>$request->saran,
                'nameOther'=>$request->nameOther,
                'other'=>$request->other,
                'saranOther'=>$request->saranOther,
            ];
                        
            // dd($da);
            $form = $formulir;                          
            $form->forms_id = 1;
            
            $form->tanggal = $request->tanggal;            
            $form->noreg = $request->noreg;            
            $form->tipe = $request->tipe;            
            $form->status = $request->status;
            $form->villages_id = $request->village;

            if($request->tipe == 'doc' && $request->hasFile('file'))
            {
                $pile = $request->file('file');               
                $piles = 'pile_'.time().'.'.$pile->getClientOriginalExtension();
                $destinationPath = public_path('assets/doc');
                $pile->move($destinationPath, $piles);
                $form->dokumen = $piles;
            }        
            $form->items = json_encode($da);

            $form->update();

            return redirect()->route('formulir.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formulir  $formulir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formulir $formulir)
    {
        $formulir->delete();
        Alert::success('info', 'Delete Success');
        return back();
    }
}
