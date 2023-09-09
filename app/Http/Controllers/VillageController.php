<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;
use App\Models\District;
use Alert;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data ='Data Desa';
        $da = Village::all();
        return view('admin.village.index',compact('data','da'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data ='Tambah data';      
        $dis = District::all();
        return view('admin.village.create',compact('data','dis'));
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
            'district' => 'required',        
        ],[
            'name.required'=>'Field harus diisi',   
            'district.required'=>'Field harus diisi',                
        ]);


        $village = new Village();
        $village->nama = $request->name;
        $village->districts_id = $request->district;
        $village->save();
        
        return redirect('/dashboard/village');    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function show(Village $village)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function edit(Village $village)
    {
        $data ='Edit Data';
        $da = Village::all();
        $dis = District::all();
        return view('admin.village.create',compact('data','da','village','dis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Village $village)
    {
        $request->validate([
            'name' => 'required',    
            'district' => 'required',        
        ],[
            'name.required'=>'Field harus diisi',   
            'district.required'=>'Field harus diisi',                
        ]);

        
        $village->nama = $request->name;
        $village->districts_id = $request->district;
        $village->save();
        
        return redirect('/dashboard/village');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function destroy(Village $village)
    {
        $village->delete();
        Alert::success('info', 'Delete Success');
        return back();
    }
}
