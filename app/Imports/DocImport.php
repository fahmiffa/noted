<?php

namespace App\Imports;

use App\Models\doc;
use App\Models\Formulir;
use Maatwebsite\Excel\Concerns\ToModel;
use Auth;

class DocImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {                
        $da = [
            'no'=> $row[1],
            'header'=>null,
            'items'=>null,
            'sub'=>null,
            'saranItem'=>null,
            'saranSub'=>null,
            'saran'=>null,
            'nameOther'=>null,
            'other'=>null,
            'saranOther'=>null,
        ];

        $doc = new Formulir();
        $doc->tanggal = $row[0];
        $doc->nomor = $row[1];
        $doc->noreg = $row[2];                
        $doc->status = $row[3]; 
        $doc->items = json_encode($da);
        $doc->users_id = Auth::user()->id;      
        $doc->save();

        return $doc;
    }
    
}
