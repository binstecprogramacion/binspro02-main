<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Catcontingencia;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index(){

        $catcontingencias = Catcontingencia::paginate(5);
        $cargos = Cargo::paginate(6);

        return view('Cargo.index', compact('cargos','catcontingencias'));

    }

    public function store(Request $request){
        
        $request->validate([
            'cargo'         => 'required',
            'descripcion'   => 'required'
        ]);
        
        $cargo = new Cargo();

        $cargo -> cargo        = $request->cargo;
        $cargo -> descripcion        = $request->descripcion;

        $cargo ->save();

        return redirect() -> route('cargo.index');
    }

    public function update(Request $request, Cargo $cargo){

        $request->validate([
            'cargo'         => 'required',
            'descripcion'   => 'required'
        ]);
        
        $cargo -> cargo        = $request->cargo;
        $cargo -> descripcion  = $request->descripcion;

        $cargo ->save();

        return redirect() -> route('cargo.index');
    }

    public function destroy(Cargo $cargo){

        $cargo->delete();

        return redirect()->route('persona.index');
    }
}
