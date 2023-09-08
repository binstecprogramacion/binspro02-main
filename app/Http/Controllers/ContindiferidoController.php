<?php

namespace App\Http\Controllers;

use App\Models\Contindiferido;
use App\Models\Cuenta;
use Illuminate\Http\Request;

class ContindiferidoController extends Controller
{
    public function store(Request $request, Cuenta $cuenta){
        
        $request->validate([
            'partida'       => 'required',
            'Saldo'       => 'required',
            'anio'       => 'required',
            'catcontingencias_id'       => 'required'
        ]);

        
        
        $contindiferido = new Contindiferido();

        $contindiferido -> partida  = $request->partida;
        $contindiferido -> Saldo    = $request->Saldo;
        $contindiferido -> anio     = $request->anio;
        $contindiferido -> catcontingencias_id   = $request->catcontingencias_id;

        $contindiferido -> SaldoRestante    = $request->Saldo;
        $contindiferido -> cuentas_id    = $cuenta->id;


        $contindiferido ->save();


        return redirect() -> route('htestructuras.index',$cuenta->id);
    }

    public function update(Request $request, Contindiferido $contindiferido){
        
        $request->validate([
            'partida'       => 'required',
            'Saldo'       => 'required',
            'anio'       => 'required',
            'catcontingencias_id'       => 'required'
        ]);

        

        $contindiferido -> partida  = $request->partida;
        $contindiferido -> Saldo    = $request->Saldo;
        $contindiferido -> anio     = $request->anio;
        $contindiferido -> catcontingencias_id   = $request->catcontingencias_id;

        $contindiferido -> SaldoRestante    = $request->Saldo;


        $contindiferido ->save();


        return redirect() -> route('htestructuras.index',$contindiferido -> cuentas_id);
    }

    public function destroy(Contindiferido $contindiferido){
        
        $contindiferido->delete();

        return redirect() -> route('htestructuras.index',$contindiferido -> cuentas_id);
    }
}
