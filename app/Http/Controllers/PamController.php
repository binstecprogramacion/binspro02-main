<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Htcategoria;
use App\Models\Htestructura;
use App\Models\mese;
use App\Models\Pam;
use App\Models\Sede;
use Illuminate\Http\Request;

class PamController extends Controller
{
    public function index(Cuenta $cuenta){

        $pams = Pam::where('cuentas_id',$cuenta->id)->get();
        $sedes = Sede::where('cuenta_id',$cuenta->id)->paginate(5);
        $htestructuras = Htestructura::where('cuentas_id',$cuenta->id)->get();
        $htcategorias = Htcategoria::all();
        $meses = mese::all();
        $sedesTo = Sede::where('cuenta_id',$cuenta->id)->get();
        

        return view('Pam.index', compact('pams','cuenta','sedes','htestructuras','htcategorias', 'meses','sedesTo'));

    }

    public function show(Htestructura $htestructura){
            
        
        $sedes = Sede::where('cuenta_id',$htestructura->cuentas_id)->get();
        $pams = Pam::where('htestructuras_id',$htestructura->id)->get();
        $cuentas = Cuenta::where('id',$htestructura->cuentas_id)->get();
        $htcategorias = Htcategoria::where('id',$htestructura->htcategorias_id)->get();
        $meses = mese::all();

        

        //OTRAM NAERA DE HACERLO
        //si es que l variables coninciden o son iguales
        return view('Pam.show',compact('pams','htestructura','cuentas','htcategorias','sedes', 'meses'));

    }

    public function store(Request $request , Htestructura $htestructura){
        
        $request->validate([
            'mes'           => 'required',
            'estado'        => 'required',
            'sedes_id'      => 'required'

        ]);

        
        
        $pam = new Pam();

        $pam -> estado      = $request->estado;
        $pam -> mes         = $request->mes;
        $pam -> sedes_id    = $request->sedes_id;

        $pam -> htestructuras_id    = $htestructura->id;
        $pam -> cuentas_id          = $htestructura->cuentas_id;

        $pam ->save();


        return redirect() -> route('pam.show',$htestructura->id);
    }

    public function create(Request $request , Cuenta $cuenta){
        
        $request->validate([
            'mes'               => 'required',
            'estado'            => 'required',
            'sedes_id'          => 'required',
            'htestructuras_id'  => 'required'

        ]);

        
        
        $pam = new Pam();

        $pam -> estado      = $request->estado;
        $pam -> mes         = $request->mes;
        $pam -> sedes_id    = $request->sedes_id;

        $pam -> htestructuras_id    = $request->htestructuras_id;
        $pam -> cuentas_id          = $cuenta->id;

        $pam ->save();


        return redirect() -> route('pam.index', $pam->cuentas_id);
    }

    public function update(Request $request, Pam $pam){

        $request->validate([
            'mes'           => 'required',
            'estado'        => 'required'

        ]);
        
        $pam -> estado      = $request->estado;
        $pam -> mes         = $request->mes;

        $pam ->save();

        return redirect() -> route('pam.show', $pam->htestructuras_id);
    }

    public function edit(Request $request, Pam $pam){

        $request->validate([
            'mes'           => 'required',
            'estado'        => 'required'

        ]);
        
        $pam -> estado      = $request->estado;
        $pam -> mes         = $request->mes;

        $pam ->save();

        return redirect() -> route('pam.index', $pam->cuentas_id);
    }

    public function destroy(Pam $pam){
        $pam->delete();

        return redirect()->route('pam.show', $pam->htestructuras_id);
    }

    public function delite(Pam $pam){
        $pam->delete();

        return redirect()->route('pam.index', $pam->cuentas_id);
    }
}
