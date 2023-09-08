<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitudservreque extends Model
{
    use HasFactory;

    //relacion muchos a uno (Requerimiento)
    public function requerimiento(){
        return $this->belongsTo(Requerimiento::class);
    }

    //relacion muchos a uno (Contindiferido)
    public function contindiferido(){
        return $this->belongsTo(Contindiferido::class);
    }

    //relacion muchos a uno (OMOLOGADO)
    public function omologado(){
        return $this->belongsTo(Omologado::class);
    }
}
