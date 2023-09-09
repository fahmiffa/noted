<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function title()
    {
        return $this->hasOne(Title::class,'id','titles_id');        
    }

    public function sub()
    {
        return $this->hasMany(Sub::class,'items_id','id');        
    }
}
