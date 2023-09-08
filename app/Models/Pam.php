<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Pam extends Model
{
    use HasFactory;

    //relacion muchos a uno (CUENTA)
    public function cuenta(){
        return $this->belongsTo(Cuenta::class);
    } 

    //relacion muchos a uno (HTESTRUCTURA)
    public function htestructura(){
        return $this->belongsTo(Htestructura::class);
    } 

    //relacion muchos a uno (SEDE)
    public function sede(){
        return $this->belongsTo(Sede::class);
    }



    protected function mes(): Attribute
    {
        return new Attribute(

            get: function($value){
                return strtolower($value);
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
