<?php

namespace App\Http\Controllers;

use App\Models\Proveedo;
use Illuminate\Http\Request;

class ProveedoController extends Controller
{
    public function index(){

        $proveedos = Proveedo::paginate(8);

        return view('proveedor.index', compact('proveedos'));

    }

    public function store(Request $request){
        
        $request->validate([
            //'rucProv'       => 'required|unique:proveedos|max:11',
            'rucProv'       => 'required|max:15',
            'razSocProv'    => 'required|unique:proveedos|max:100',
            'nombProv'      => 'required|unique:proveedos|max:100',
            'celularProv'   => 'required|max:9|min:7',
            'correoProv'    => 'required'

        ]);

        
        
        $proveedo = new Proveedo();

        $proveedo -> rucProv        = $request->rucProv;
        $proveedo -> razSocProv     = $request->razSocProv;
        $proveedo -> nombProv       = $request->nombProv;
        $proveedo -> celularProv    = $request->celularProv;
        $proveedo -> correoProv     = $request->correoProv;

        $proveedo ->save();

        return redirect() -> route('proveedos.index');
    }

    public function update(Request $request, Proveedo $proveedo){
        
        $proveedo -> rucProv        = $request->rucProv;
        $proveedo -> razSocProv     = $request->razSocProv;
        $proveedo -> nombProv       = $request->nombProv;
        $proveedo -> celularProv    = $request->celularProv;
        $proveedo -> correoProv     = $request->correoProv;

        $proveedo ->save();

        return redirect() -> route('proveedos.index');
    }

    public function destroy(Proveedo $proveedo){
        $proveedo->delete();

        return redirect()->route('proveedos.index');
    }
}
