<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    public function title()
    {
        return $this->hasMany(Title::class,'contents_id','id');        
    }

}
