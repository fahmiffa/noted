<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    public function content()
    {
        return $this->hasOne(Content::class,'id','contents_id');        
    }

    public function item()
    {
        return $this->hasMany(Item::class,'titles_id','id');        
    }
}
