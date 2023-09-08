<?php

namespace App\Http\Controllers;

use App\Models\Pirson;
use Illuminate\Http\Request;

class PirsonController extends Controller
{
    public function index(){

        $pirsons = Pirson::paginate(6);

        return view('Personal.index', compact('pirsons'));

    }

    public function store(Request $request){
        
        $request->validate([
            'nombre'         => 'required',
            'apellidos'         => 'required',
            'docIdentidad'         => 'required',
            'telefono'         => 'required',
            'direccion'   => 'required'
        ]);
        
        $pirson = new Pirson();

        $pirson -> nombre        = $request->nombre;
        $pirson -> apellidos        = $request->apellidos;
        $pirson -> docIdentidad        = $request->docIdentidad;
        $pirson -> telefono        = $request->telefono;
        $pirson -> direccion        = $request->direccion;

        $pirson ->save();

        return redirect() -> route('persona.index');
    }

    public function update(Request $request, Pirson $pirson){

        $request->validate([
            'nombre'         => 'required',
            'apellidos'         => 'required',
            'docIdentidad'         => 'required',
            'telefono'         => 'required',
            'direccion'   => 'required'
        ]);
        

        $pirson -> nombre        = $request->nombre;
        $pirson -> apellidos        = $request->apellidos;
        $pirson -> docIdentidad        = $request->docIdentidad;
        $pirson -> telefono        = $request->telefono;
        $pirson -> direccion        = $request->direccion;

        $pirson ->save();

        return redirect() -> route('persona.index');
    }

    public function destroy(Pirson $pirson){
        
        $pirson->delete();

        return redirect()->route('persona.index');
    }
}
