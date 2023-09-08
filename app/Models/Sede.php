<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Sede extends Model
{
    use HasFactory;

    //relacion muchos a uno
    public function cuenta(){
        return $this->belongsTo(Cuenta::class);
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

    protected function nomSede(): Attribute
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

    protected function direccion(): Attribute
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
