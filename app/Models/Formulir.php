<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulir extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasOne(User::class,'id','users_id');
    }

    public function form()
    {
        return $this->hasOne(User::class,'id','forms_id');
    }

    public function desa()
    {
        return $this->hasOne(Village::class,'id','villages_id');        
    }
}
