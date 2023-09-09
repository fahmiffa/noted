<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    public function header()
    {
        return $this->hasOne(Header::class,'id','headers_id');        
    }

    public function content()
    {
        return $this->hasOne(content::class,'id','contents_id');        
    }
}
