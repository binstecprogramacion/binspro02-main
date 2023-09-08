<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejecucione extends Model
{
    use HasFactory;

    //relacion muchos a uno (PAM)
    public function pam(){
        return $this->belongsTo(Pam::class);
    } 
}
