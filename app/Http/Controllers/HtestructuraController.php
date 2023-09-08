<?php

namespace App\Http\Controllers;

use App\Models\Catcontingencia;
use App\Models\Contindiferido;
use App\Models\Cuenta;
use App\Models\Ejecucione;
use App\Models\Htcategoria;
use App\Models\Htestructura;
use App\Models\Pam;
use Illuminate\Http\Request;

class HtestructuraController extends Controller
{
    public function index(Cuenta $cuenta){

        //$htestructuras = Htestructura::paginate(10);
        $htestructuras = Htestructura::where('cuentas_id',$cuenta->id)->paginate(10);
        //return $htestructuras;
        //return $cuenta->id;
        $htcategorias = Htcategoria::all();
        $contindiferidos = Contindiferido::where('cuentas_id',$cuenta->id)->paginate(10);
        $catcontingencias = Catcontingencia::all();

        return view('EstructuraHT.index', compact('htestructuras','cuenta','htcategorias','contindiferidos','catcontingencias'));

    }

    public function store(Request $request, Cuenta $cuenta){
        
        $request->validate([
            'anio'       => 'required',
            'cantidad'       => 'required',
            'frecuencia'       => 'required',
            'numfrecuencia'       => 'required',
            'CostoUnitario'       => 'required',
            'PrecioUnitario'       => 'required'
        ]);

        
        
        $htestructura = new Htestructura();

        $htestructura -> cuentas_id   = $cuenta->id;
        $htestructura -> htcategorias_id   = $request->htcategorias_id;
        

        $htestructura -> anio   = $request->anio;
        $htestructura -> cantidad   = $request->cantidad;
        $htestructura -> frecuencia   = $request->frecuencia;
        $htestructura -> numfrecuencia   = $request->numfrecuencia;
        $htestructura -> CostoUnitario   = $request->CostoUnitario;
        $htestructura -> PrecioUnitario   = $request->PrecioUnitario;

        $cantidad = $request->cantidad;
        $numfrecuencia = $request->numfrecuencia;
        $CostoUnitario = $request->CostoUnitario;
        $PrecioUnitario = $request->PrecioUnitario;

        $htestructura -> CostoMensual     = ( $cantidad * $numfrecuencia * $CostoUnitario)/12;
        $htestructura -> CostoAnual     = ( $cantidad * $numfrecuencia * $CostoUnitario);

        $htestructura -> PrecioMensual     = ( $cantidad * $numfrecuencia * $PrecioUnitario)/12;
        $htestructura -> PrecioAnual     = ( $cantidad * $numfrecuencia * $PrecioUnitario);


        $htestructura -> CostoAnualRestante   = $htestructura -> CostoAnual ;
        $htestructura -> PrecioAnualRestante   = $htestructura -> PrecioAnual ;


        $htestructura ->save();

        return redirect() -> route('htestructuras.index',$cuenta->id);
    }

    public function update(Request $request, Htestructura $htestructura){
        
        
        $htestructura -> htcategorias_id   = $request->htcategorias_id;
        

        $htestructura -> anio   = $request->anio;
        $htestructura -> cantidad   = $request->cantidad;
        $htestructura -> frecuencia   = $request->frecuencia;
        $htestructura -> numfrecuencia   = $request->numfrecuencia;
        $htestructura -> CostoUnitario   = $request->CostoUnitario;
        $htestructura -> PrecioUnitario   = $request->PrecioUnitario;

        $cantidad = $request->cantidad;
        $numfrecuencia = $request->numfrecuencia;
        $CostoUnitario = $request->CostoUnitario;
        $PrecioUnitario = $request->PrecioUnitario;

        $htestructura -> CostoMensual     = ( $cantidad * $numfrecuencia * $CostoUnitario)/12;
        $htestructura -> CostoAnual     = ( $cantidad * $numfrecuencia * $CostoUnitario);

        $htestructura -> PrecioMensual     = ( $cantidad * $numfrecuencia * $PrecioUnitario)/12;
        $htestructura -> PrecioAnual     = ( $cantidad * $numfrecuencia * $PrecioUnitario);

        $htestructura -> CostoAnualRestante   = $htestructura -> CostoAnual ;
        $htestructura -> PrecioAnualRestante   = $htestructura -> PrecioAnual ;

        $pams = Pam::where('htestructuras_id',$htestructura->id)->get();
        $costoEjecucion = 0;
        $precioEjecucion = 0;

        foreach ($pams as $pam) {
            $ejecuciones = Ejecucione::where('pams_id',$pam->id)->get();

            foreach ($ejecuciones as $ejecucione) {

                if ($ejecucione->estado_ejecucion == "facturado") {
                    $costoEjecucion += $ejecucione->Costo;
                    $precioEjecucion += $ejecucione->Precio;
                }
            }
        }

        $htestructura -> CostoAnualRestante   -= $costoEjecucion ;
        $htestructura -> PrecioAnualRestante  -= $precioEjecucion ;

        $htestructura ->save();

        return redirect() -> route('htestructuras.index',$htestructura -> cuentas_id);
    }

    public function destroy(Htestructura $htestructura){
        
        $htestructura->delete();

        return redirect()->route('htestructuras.index',$htestructura -> cuentas_id);
    }
}
