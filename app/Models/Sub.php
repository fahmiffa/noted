<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->hasOne(Item::class,'id','items_id');        
    }
}
