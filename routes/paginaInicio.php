<?php

use App\Http\Controllers\PaginaWebInicioController;
use Illuminate\Support\Facades\Route;

Route::controller(PaginaWebInicioController::class)->group(function(){

    Route::get('inicio/Web','index')->name('inicioWeb.index');

});