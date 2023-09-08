<?php

namespace App\Http\Controllers;

use App\Models\Especialida;
use Illuminate\Http\Request;

class EspecialidaController extends Controller
{
    public function index(){

        $especialidas = Especialida::paginate(8);

        return view('especialidad.index', compact('especialidas'));

    }

    public function store(Request $request){

        $request->validate([
            'nombreEspecialidad' => 'required'
        ]);
        
        $especialida = new Especialida();

        $especialida -> nombreEspecialidad = $request->nombreEspecialidad;

        $especialida ->save();

        return redirect() -> route('especialidas.index');
    }

    public function update(Request $request, Especialida $especialida){
        
        $especialida -> nombreEspecialidad = $request->nombreEspecialidad;

        $especialida ->save();

        return redirect() -> route('especialidas.index');
    }

    public function destroy(Especialida $especialida){
        $especialida->delete();

        return redirect()->route('especialidas.index');
    }
}
