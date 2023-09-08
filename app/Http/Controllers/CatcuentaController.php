<?php

namespace App\Http\Controllers;

use App\Models\Catcuenta;
use Illuminate\Http\Request;

class CatcuentaController extends Controller
{
    public function index(){

        $catcuentas = Catcuenta::paginate(4);

        return view('categoriaCuenta.index', compact('catcuentas'));

    }

    public function store(Request $request){
        
        $request->validate([
            'CatgEmpresa'    => 'required|unique:catcuentas|max:100'

        ]);
        
        $catcuenta = new Catcuenta();

        $catcuenta -> CatgEmpresa        = $request->CatgEmpresa;

        $catcuenta ->save();

        return redirect() -> route('catcuentas.index');
    }

    public function update(Request $request, Catcuenta $catcuenta){
        
        $catcuenta -> CatgEmpresa        = $request->CatgEmpresa;

        $catcuenta ->save();

        return redirect() -> route('catcuentas.index');
    }

    public function destroy(Catcuenta $catcuenta){
        
        $catcuenta->delete();

        return redirect()->route('catcuentas.index');
    }
}
