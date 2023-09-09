<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Alert;
use App\Models\doc;
use App\Models\User as Us;
use Illuminate\Support\Facades\Validator;
use App\Models\Village;
use PDF;
use App\Models\Form;
use App\Models\Formulir;
use QrCode;

class User extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reg' => 'required',
            'doc' => 'required',         
        ],[
            'reg.required'=>'Field harus diisi',
            'doc.required'=>'Field harus diisi', 
        ]);        
        $val = Formulir::where('noreg',$request->reg)->where('nomor',$request->doc)->first();          
        if($val)
        {   
            return back()->with('res',$val)->withInput();      
        }
        else
        {   
            return back()->with('none','Data tidak ditemukan')->withInput();
        }

    }

    public function home()
    {
        return view('home');
    }

    public function index()
    {                     
        $doc = doc::where('users_id',Auth::user()->id)->count();
        $data = 'Dashboard';        
        return view('user.blank',compact('data','doc'));
    }

    public function data($reg,$doc)
    {                          
        $val = doc::where('noreg',$reg)->where('nodoc',$doc)->first();        
        return view('home',compact('val'));
    }

    public function formulir($val)
    {
        $val = explode('&',base64_decode($val));
        $reg = $val[0];
        $nomor = $val[1];
        $da = Formulir::where('nomor',$nomor);

        
        if($da->exists())
        {
            $row =  $da->first();                                  
            $items = json_decode($row->items);
            $header = $items->header;
            return view('cek',compact('row','header'));
        }
        else
        {
            Alert::warning('error', 'Dokumen tidak tersedia');
            return redirect()->route('home');
        }
    }

    public function edit($id)
    {
        $user = Us::findOrFail($id);   
        $data ='Edit user';                              
        return view('admin.user.edit',compact('user','data'));
    }

    public function update(Request $request, $id)
    {
        $messages   =   [
            'name.required'      =>  'nama harus di isi',                        
            'email.required'     =>  'Email harus di isi',                                                                                 
            'email.unique'       =>  'Email sudah ada',         
            'password.regex'     =>  'Password harus kombinasi Huruf dan Angka',                                                                             
        ];


        $validasi = Validator::make(
            $request->all(),
            [                       
                'name' => 'required',
                'email' => 'required|unique:users,email,'.$id,    
                'password' => 'nullable|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'                            
            ],
            $messages
        );
        if ($validasi->fails()) {            
            return back()->withErrors($validasi)->withInput();
        } else {
                          
            $user = Us::findOrFail($id);   
            $user->name = $request->name;
            $user->email = $request->email;                        
            if($request->password != null)
            {
                $user->password = bcrypt($request->password);
            }            
            $user->update(); 
            Alert::info('Succes', 'Update Succesfully');
            return redirect()->route('user');
        }
    }

    public function sort(Request $request)
    {                
        $data ='Data Formulir';
        $year = $request->get('year');
        
        if(Auth::user()->role == 'admin')
        {
            $da = Formulir::whereYear('tanggal','=',$request->get('year'))->get();                              
        }
        else
        {
            $da = Formulir::whereYear('tanggal','=',$request->get('year'))
            ->where('users_id',Auth::user()->id)
            ->get();                              
        }        
        return view('formulir.index',compact('data','da'));
    }

    public function filter(Request $request)
    {        
        $year = $request->get('year');
        $data ='List Data';
        if(Auth::user()->role == 'admin')
        {
            $da = doc::whereYear('tanggal','=',$request->get('year'))->get();                              
        }
        else
        {
            $da = doc::whereYear('tanggal','=',$request->get('year'))
            ->where('users_id',Auth::user()->id)
            ->get();                              
        }
    
        return view('admin.data.index',compact('data','da','year'));
    }

    public function village(Request $request)
    {
        $da = Village::where('districts_id',$request->id)->pluck('nama', 'id');
        return response()->json($da);
    }

}
