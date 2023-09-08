<?php

namespace App\Http\Controllers;

use App\Models\Catcontingencia;
use Illuminate\Http\Request;

class CatcontingenciaController extends Controller
{
    public function index(){

        $catcontingencias = Catcontingencia::paginate(5);


        return view('CatContingencia.index', compact('catcontingencias'));
    }

    public function store(Request $request){
        
        $request->validate([
            'categoriaContin'   => 'required',
            'descripcion'       => 'required'
        ]);
        
        $catcontingencia = new Catcontingencia();

        $catcontingencia -> categoriaContin        = $request->categoriaContin;
        $catcontingencia -> descripcion        = $request->descripcion;

        $catcontingencia ->save();

        return redirect() -> route('catContinge.index');
    }

    public function update(Request $request, Catcontingencia $catcontingencia){

        $request->validate([
            'categoriaContin'         => 'required',
            'descripcion'   => 'required'
        ]);
        
        $catcontingencia -> categoriaContin        = $request->categoriaContin;
        $catcontingencia -> descripcion  = $request->descripcion;

        $catcontingencia ->save();

        return redirect() -> route('catContinge.index');
    }




    public function destroy(Catcontingencia $catcontingencia){

        $catcontingencia->delete();

        return redirect()->route('catContinge.index');
    }
}
