<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;
use Alert;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {                       
        $data ='Data Kecamatan';
        $da = District::all();
        return view('admin.district.index',compact('data','da'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data ='Tambah data';        
        return view('admin.district.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',        
        ],[
            'name.required'=>'Field harus diisi',                
        ]);


        $dis = new District();
        $dis->nama = $request->name;
        $dis->save();
        
        return redirect('/dashboard/district');    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        $data ='Edit data';        
        return view('admin.district.create',compact('data','district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        $request->validate([
            'name' => 'required',        
        ],[
            'name.required'=>'Field harus diisi',                
        ]);
        
        $district->nama = $request->name;
        $district->save();
        
        return redirect('/dashboard/district');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        $district->delete();
        Alert::success('info', 'Delete Success');
        return back();
    }
}
