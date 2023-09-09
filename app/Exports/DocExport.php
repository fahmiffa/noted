<?php

namespace App\Exports;

use App\Models\Formulir;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromArray;

class DocExport implements FromArray, WithHeadings
{  
    public function array() :array
    {

        $doc = Formulir::all();
        foreach($doc as $row)
        {
            $da[]= [
                    $row->tanggal,
                    $row->nomor,                   
                    $row->noreg,  
                    $row->status,              
                    $row->users->name,                   
                    ];
        }

        return $da;
    }

    public function headings() : array
    {
        return ['Tanggal','No. Dokumen','No. Registrasi','Status','Verifikator'];
    }
}
