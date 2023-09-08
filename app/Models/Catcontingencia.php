<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catcontingencia extends Model
{
    use HasFactory;

    //RELACION UNO A MUCHOS (Contindiferido)
    public function contindiferido()
    {
        return $this->hasMany(Contindiferido::class);
    }

    
}
