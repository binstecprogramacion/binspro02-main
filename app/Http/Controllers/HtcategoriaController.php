<?php

namespace App\Http\Controllers;

use App\Models\Htcategoria;
use Illuminate\Http\Request;

class HtcategoriaController extends Controller
{
    public function index(){

        $htcategorias = Htcategoria::paginate(8);

        return view('CategoriaHT.index', compact('htcategorias'));

    }

    public function store(Request $request){
        
        $request->validate([
            'especialidad'       => 'required'
        ]);

        
        
        $htcategoria = new Htcategoria();

        $htcategoria -> especialidad   = $request->especialidad;
        $htcategoria -> categoria   = $request->categoria;
        $htcategoria -> descCatHT     = $request->descCatHT;

        $htcategoria ->save();

        return redirect() -> route('htcategorias.index');
    }

    public function update(Request $request, Htcategoria $htcategoria){
        
        $htcategoria -> especialidad   = $request->especialidad;
        $htcategoria -> categoria   = $request->categoria;
        $htcategoria -> descCatHT     = $request->descCatHT;

        $htcategoria ->save();

        return redirect() -> route('htcategorias.index');
    }

    public function destroy(Htcategoria $htcategoria){
        $htcategoria->delete();

        return redirect()->route('htcategorias.index');
    }
}
