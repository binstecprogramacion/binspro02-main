<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Omologado extends Model
{
    use HasFactory;

    //relacion muchos a uno (ALCANCE)
    public function alcance(){
        return $this->belongsTo(Alcance::class);
    } 

    //relacion muchos a uno (ESPECIALIDA)
    public function especialida(){
        return $this->belongsTo(Especialida::class);
    } 

    //relacion muchos a uno (PROVEEDO)
    public function proveedo(){
        return $this->belongsTo(Proveedo::class);
    } 

    //RELACION UNO A MUCHOS (Solicitud SERVICIO REQ)
    public function solicitudservreque()
    {
        return $this->hasMany(Solicitudservreque::class);
    }

    /*

    //RELACION UNO A MUCHOS (REQUERIMIENTO)
    public function requerimiento()
    {
        return $this->hasMany(Requerimiento::class);
    }

    */
}
