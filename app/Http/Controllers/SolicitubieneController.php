<?php

namespace App\Http\Controllers;

use App\Models\Requerimiento;
use App\Models\Solicitubiene;
use Illuminate\Http\Request;

class SolicitubieneController extends Controller
{
    public function store(Request $request, Requerimiento $requerimiento){
    
        $request->validate([
            'collaborators_id' => 'required',
            'costoMaterial' => 'required',
            'precio' => 'required',
            'estado' => 'required',
            'contindiferidos_id' => 'required'
        ]);
        
        $solicitubienes = new Solicitubiene();

        $solicitubienes -> collaborators_id    = $request->collaborators_id;
        $solicitubienes -> costoMaterial       = $request->costoMaterial;
        $solicitubienes -> precio              = $request->precio;
        $solicitubienes -> contindiferidos_id  = $request->contindiferidos_id;
        $solicitubienes -> estado              = $request->estado;
        $solicitubienes -> requerimientos_id   = $requerimiento->id;

        $solicitubienes -> AprobacionADM       = "pendiente";
        $solicitubienes -> AprobacionJOP       = "pendiente";
        $solicitubienes -> AprobacionGG        = "pendiente";

        $solicitubienes ->save();
        
        return redirect()->route('requerimiento.ejecucionReq' , $requerimiento->id );
    }

    public function update(Request $request , Solicitubiene $solicitubienes){
    
        $request->validate([
            'collaborators_id' => 'required',
            'costoMaterial' => 'required',
            'precio' => 'required',
            'estado' => 'required',
            'contindiferidos_id' => 'required'
        ]);
        

        $solicitubienes -> collaborators_id    = $request->collaborators_id;
        $solicitubienes -> costoMaterial       = $request->costoMaterial;
        $solicitubienes -> precio              = $request->precio;
        $solicitubienes -> contindiferidos_id  = $request->contindiferidos_id;
        $solicitubienes -> estado              = $request->estado;

        $solicitubienes -> AprobacionADM       = "pendiente";
        $solicitubienes -> AprobacionJOP       = "pendiente";
        $solicitubienes -> AprobacionGG        = "pendiente";

        $solicitubienes ->save();
        

        return redirect()->route('requerimiento.ejecucionReq' , $solicitubienes -> requerimientos_id );
    }

    public function aproadmin(Solicitubiene $solicitubienes){
    
        if ($solicitubienes->AprobacionADM == null || $solicitubienes->AprobacionADM == "pendiente") {
            $solicitubienes->AprobacionADM = "aprobado";
        }elseif ($solicitubienes->AprobacionADM == "aprobado") {
            $solicitubienes->AprobacionADM = "pendiente";
        }
        
        $solicitubienes ->save();

        return redirect()->route('requerimiento.ejecucionReq' , $solicitubienes -> requerimientos_id );
    }

    public function aprojop(Solicitubiene $solicitubienes){
    
        if ($solicitubienes->AprobacionJOP == null || $solicitubienes->AprobacionGG == "pendiente") {
            $solicitubienes->AprobacionJOP = "aprobado";
        }elseif ($solicitubienes->AprobacionJOP == "aprobado") {
            $solicitubienes->AprobacionJOP = "pendiente";
        }
        
        $solicitubienes ->save();

        return redirect()->route('requerimiento.ejecucionReq' , $solicitubienes -> requerimientos_id );
    }

    public function aprogg(Solicitubiene $solicitubienes){
    
        if ($solicitubienes->AprobacionGG == null || $solicitubienes->AprobacionGG == "pendiente") {
            $solicitubienes->AprobacionGG = "aprobado";
        }elseif ($solicitubienes->AprobacionGG == "aprobado") {
            $solicitubienes->AprobacionGG = "pendiente";
        }
        
        $solicitubienes ->save();

        return redirect()->route('requerimiento.ejecucionReq' , $solicitubienes -> requerimientos_id );
    }
}
