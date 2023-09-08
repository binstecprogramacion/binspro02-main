<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    use HasFactory;

    //RELACION MUCHOS  A UNO (Cargo)
    public function cargo(){
        return $this->belongsTo(Cargo::class);
    }

    //RELACION MUCHOS  A UNO (Cuenta)
    public function cuenta(){
        return $this->belongsTo(Cuenta::class);
    }

    //RELACION MUCHOS  A UNO (Person)
    public function people(){
        return $this->belongsTo(People::class);
    }

    //RELACION UNO A MUCHOS (Solicitud BIENES Y MATERIALES)
    public function solicitubiene()
    {
        return $this->hasMany(Solicitubiene::class);
    }
/*
    //RELACION UNO A MUCHOS (REQUERIMIENTO)
    public function requerimiento()
    {
        return $this->hasMany(Requerimiento::class);
    }
    */
}
