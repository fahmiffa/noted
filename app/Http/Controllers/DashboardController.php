<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Http;
use Alert;
use App\Models\User;
use App\Models\doc;
use App\Exports\DocExport;
use App\Imports\DocImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{

    public function index()
    {                                 
        $user = User::where('role','operator')->count();
        $doc = doc::count();        
        return view('admin.main',compact('user','doc'));        
    }

    public function export()
    {
        return Excel::download(new DocExport(), 'doc.xlsx');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = $file->hashName();

        //temporary file
        $path = $file->storeAs('public/excel/',$nama_file);

        // import data
        $import = Excel::import(new DocImport(), storage_path('app/public/excel/'.$nama_file));

        //remove from server
        Storage::delete($path);

        if($import) {                        
            Alert::success('Info', 'Data Berhasil Diimport');
            return back();
        } else {                        
            Alert::error('Error', 'Data Gagal Diimport!');
            return back();
        }
    }

}
