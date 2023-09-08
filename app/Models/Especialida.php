<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialida extends Model
{
    use HasFactory;

    //RELACION UNO A MUCHOS (OMOLOGADO)
    public function omologado()
    {
        return $this->hasMany(Omologado::class);
    }
}
