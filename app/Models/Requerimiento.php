<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Requerimiento extends Model
{
    use HasFactory;

    //relacion muchos a uno CUENTA  
    public function cuenta(){
        return $this->belongsTo(Cuenta::class);
    } 

    //relacion muchos a uno SEDE
    public function sede(){
        return $this->belongsTo(Sede::class);
    } 

    //relacion muchos a uno USER
    public function user(){
        return $this->belongsTo(User::class);
    } 

    //RELACION UNO A MUCHOS (Reqobservaciones)
    public function reqobservaciones()
    {
        return $this->hasMany(Reqobservaciones::class);
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

    /*

    //relacion muchos a uno OMOLOGADO
    public function omologado(){
        return $this->belongsTo(Omologado::class);
    } 

    //relacion muchos a uno COLLABORATOR
    public function collaborator(){
        return $this->belongsTo(Collaborator::class);
    } 

    */

    protected function titulo(): Attribute
    {
        return new Attribute(

            get: function($value){
                return ucwords($value);
             },

            set: function($value){
               return strtolower($value);
            }
        );
    }

    protected function estado(): Attribute
    {
        return new Attribute(

            get: function($value){
                return ucwords($value);
             },

            set: function($value){
               return strtolower($value);
            }
        );
    }



}
