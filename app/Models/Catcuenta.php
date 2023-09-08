<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catcuenta extends Model
{
    use HasFactory;

    //RELACION DE UNO A MUCHOS
    public function cuenta(){
        return $this->hasMany(Cuenta::class);
    }
}
