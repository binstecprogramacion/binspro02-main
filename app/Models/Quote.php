<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    //relacion muchos a uno (CUENTA)
    public function cuenta(){
        return $this->belongsTo(Cuenta::class);
    } 

    //relacion muchos a uno (COTIZACION)
    public function documentation(){
        return $this->belongsTo(Documentation::class);
    } 
}
