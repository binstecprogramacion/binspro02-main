<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reqobservaciones extends Model
{
    use HasFactory;

    //relacion muchos a uno (Requerimiento)
    public function requerimiento(){
        return $this->belongsTo(Requerimiento::class);
    }
}
