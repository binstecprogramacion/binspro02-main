<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Htestructura extends Model
{
    use HasFactory;

    //RELACION UNO A MUCHOS (HTCATEGORIA)
    public function htcategoria()
    {
        return $this->belongsTo(Htcategoria::class);
    }

    //RELACION UNO A MUCHOS (CUENTA)
    public function cuenta(){
        return $this->belongsTo(Cuenta::class);
    } 

    //RELACION UNO A MUCHOS (PAM)
    public function pam()
    {
        return $this->hasMany(Pam::class);
    }
    
}
