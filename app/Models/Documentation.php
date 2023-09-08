<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    use HasFactory;

    //relacion muchos a uno Quote
     public function quote(){
        return $this->hasMany(Quote::class);
    }
}
