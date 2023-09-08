<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Htcategoria extends Model
{
    use HasFactory;
    
    //RELACION UNO A MUCHOS (HTESTRUCTURA)
    public function htestructura(){
        return $this->hasMany(Htestructura::class);
    }

    protected function especialidad(): Attribute
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
