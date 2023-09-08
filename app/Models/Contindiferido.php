<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contindiferido extends Model
{
    use HasFactory;

    //relacion muchos a uno (Cuenta)
    public function cuenta(){
        return $this->belongsTo(Cuenta::class);
    }

    //relacion muchos a uno (Catcontingencia)
    public function catcontingencia(){
        return $this->belongsTo(Catcontingencia::class);
    }

    //RELACION UNO A MUCHOS (Solicitud SERVICIO REQ)
    public function solicitudservreque()
    {
        return $this->hasMany(Solicitudservreque::class);
    }

    //RELACION UNO A MUCHOS (Solicitud BIENES Y MATERIALES)
    public function solicitubiene()
    {
        return $this->hasMany(Solicitubiene::class);
    }
}
