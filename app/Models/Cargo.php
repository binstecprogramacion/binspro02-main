<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Cargo extends Model
{
    use HasFactory;

    //RELACION UNO A MUCHOS (Collaborator)
    public function collaborator(){
        return $this->hasMany(Collaborator::class);
    }

    protected function cargo(): Attribute
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
