<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pamobservacione extends Model
{
    use HasFactory;

    //relacion muchos a uno (PAM)
    public function ejecucione(){
        return $this->belongsTo(Ejecucione::class);
    } 
}
