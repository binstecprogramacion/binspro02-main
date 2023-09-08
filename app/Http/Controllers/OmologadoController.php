<?php

namespace App\Http\Controllers;

use App\Models\Alcance;
use App\Models\Especialida;
use App\Models\Htcategoria;
use App\Models\Omologado;
use App\Models\Proveedo;
use Illuminate\Http\Request;

class OmologadoController extends Controller
{
    public function index(){

        $omologados     = Omologado::paginate(8);
        $alcances       = Alcance::all();
        $htcategorias   = Htcategoria::all();
        $proveedos      = Proveedo::all();


        return view('omologado.index', compact('omologados','alcances','htcategorias','proveedos'));

    }

    public function store(Request $request){
        
        $request->validate([
            'proveedos_id'      => 'required',
            'alcances_id'       => 'required',
            'htcategorias_id'   => 'required'
        ]);

        
        
        $omologado = new Omologado();

        $omologado -> proveedos_id      = $request->proveedos_id;
        $omologado -> alcances_id       = $request->alcances_id;
        $omologado -> htcategorias_id   = $request->htcategorias_id;
        $omologado -> codigo_Unico   = $request->proveedos_id.$request->alcances_id.$request->htcategorias_id;

        $omologado ->save();

        return redirect() -> route('omologados.index');
    }

    public function update(Request $request, Omologado $omologado){
        
        $omologado -> proveedos_id      = $request->proveedos_id;
        $omologado -> alcances_id       = $request->alcances_id;
        $omologado -> htcategorias_id   = $request->htcategorias_id;
        $omologado -> codigo_Unico   = $request->proveedos_id.$request->alcances_id.$request->htcategorias_id;

        $omologado ->save();

        return redirect() -> route('omologados.index');
    }

    public function destroy(Omologado $omologado){
        $omologado->delete();

        return redirect()->route('omologados.index');
    }
}
