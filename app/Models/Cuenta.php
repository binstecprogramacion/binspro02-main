<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Cuenta extends Model
{
    use HasFactory;

    //RELACION UNO A MUCHOS (INTERLOCUTOR)
    public function interlocutor()
    {
        return $this->hasMany(Interlocutor::class);
    }

    //RELACION UNO A MUCHOS (SEDES)
    public function sede()
    {
        return $this->hasMany(Sede::class);
    }

    //relacion muchos a uno Quote
    public function quote(){
        return $this->hasMany(Quote::class);
    }

    //RELACION UNO A MUCHOS (HTESTRUCTURA)
    public function htestructura(){
        return $this->hasMany(Htestructura::class);
    }

    //RELACION UNO A MUCHOS (Collaborator)
    public function collaborator(){
        return $this->hasMany(Collaborator::class);
    }

    //RELACION UNO A MUCHOS (PAM)
    public function pam()
    {
        return $this->hasMany(Pam::class);
    }

    //RELACION UNO A MUCHOS (REQUERIMIENTO)
    public function requerimiento()
    {
        return $this->hasMany(Requerimiento::class);
    }

    //RELACION UNO A MUCHOS (Contindiferido)
    public function contindiferido()
    {
        return $this->hasMany(Contindiferido::class);
    }
    
    //RELACION MUCHOS  A UNO (CATCUENTA)
    public function catcuenta(){
        return $this->belongsTo(Catcuenta::class);
    }

    protected function razonSocial(): Attribute
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
