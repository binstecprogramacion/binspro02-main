<?php

namespace App\Http\Controllers;

use App\Models\Alcance;
use App\Models\Cuenta;
use App\Models\Ejecucione;
use App\Models\Htcategoria;
use App\Models\Htestructura;
use App\Models\Omologado;
use App\Models\Pam;
use App\Models\Pamobservacione;
use App\Models\Proveedo;
use App\Models\Sede;
use Illuminate\Http\Request;

class EjecucioneController extends Controller
{
    public function index(Pam $pam){

        $cuentas = Cuenta::where('id',$pam->cuentas_id)->get();
        $htestructuras = Htestructura::where('id',$pam->htestructuras_id)->get();

        foreach ($htestructuras as $htestructura) {
            $idCateg = $htestructura->htcategorias_id;
        }

        $htcategorias = Htcategoria::where('id',$idCateg)->get();


        $sedes = Sede::where('id',$pam->sedes_id)->get();
        $omologados = Omologado::all();
        $proveedos = Proveedo::all();
        $alcances = Alcance::all();
        $proveedos = Proveedo::all();
        $ejecuciones = Ejecucione::where('pams_id',$pam->id)->get();
        $pamobservaciones = Pamobservacione::where('pams_id',$pam->id)->get();

        




        return view('EjecucionPam.index',
        compact('pam','cuentas','htestructuras','htcategorias',
        'sedes','omologados','proveedos','alcances','ejecuciones','pamobservaciones'));
    }

    public function store(Request $request, Pam $pam){
    
        $request->validate([
            'estado' => 'required',
            'Costo' => 'required',
            'Precio' => 'required',
            'omologados_id' => 'required'
        ]);
        
        $ejecucione = new Ejecucione();

        $ejecucione -> estado = $request->estado;
        $ejecucione -> Costo = $request->Costo;
        $ejecucione -> Precio = $request->Precio;
        $ejecucione -> pams_id = $pam->id;
        $ejecucione -> omologados_id = $request->omologados_id;

        $ejecucione ->save();
        

        return redirect() -> route('ejecucion.index', $pam->id);
    }

    public function update(Request $request, Ejecucione $ejecucione){
            
        $ejecucione -> estado = $request->estado;
        $ejecucione -> Costo = $request->Costo;
        $ejecucione -> Precio = $request->Precio;
        $ejecucione -> omologados_id = $request->omologados_id;

        $ejecucione ->save();

        return redirect() -> route('ejecucion.index', $ejecucione->pams_id);
    }

    public function cargaht(Ejecucione $ejecucione){


        if ($ejecucione->estado_ejecucion == null || $ejecucione->estado_ejecucion == "sin facturar") {
            
            $pams = Pam::where('id',$ejecucione->pams_id)->get();
            $idEstruc = 0;
            foreach ($pams as $pam) {
                $idEstruc = $pam->htestructuras_id ;

                $pam->estado = "realizado";
                $pam ->save();

                break;
            }

            $htestructuras = Htestructura::where('id',$idEstruc)->get();

            foreach ($htestructuras as $htestructura) {
                $htestructura->CostoAnualRestante -= $ejecucione->Costo ;
                $htestructura->PrecioAnualRestante -= $ejecucione->Precio ;
                $htestructura ->save();
            }


            $ejecucione->estado_ejecucion = "facturado";


            $ejecucione ->save();

            

        }else{
            
            $pams = Pam::where('id',$ejecucione->pams_id)->get();
            $idEstruc = 0;
            foreach ($pams as $pam) {
                $idEstruc = $pam->htestructuras_id ;

                $pam->estado = "programado";
                $pam ->save();

                break;
            }

            $htestructuras = Htestructura::where('id',$idEstruc)->get();

            foreach ($htestructuras as $htestructura) {
                $htestructura->CostoAnualRestante += $ejecucione->Costo ;
                $htestructura->PrecioAnualRestante += $ejecucione->Precio ;
                $htestructura ->save();
            }


            $ejecucione->estado_ejecucion = "sin facturar";

            

            $ejecucione ->save();


        }


        return redirect() -> route('ejecucion.index', $ejecucione->pams_id);
    }
}
