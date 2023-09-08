<?php

namespace App\Http\Controllers;

use App\Models\Pam;
use App\Models\Pamobservacione;
use Illuminate\Http\Request;

class PamobservacioneController extends Controller
{
    public function store(Request $request, Pam $pam){
        
        $request->validate([
            'titulo'    => 'required',
            'descripcion'    => 'required'

        ]);

        $pamobservacione = new Pamobservacione();

        if ($request->hasFile('imagen')) {
            $archivoImg=$request->file('imagen');
            $archivoImg->move(public_path().'/ImagenesObser/',$archivoImg->getClientOriginalName());
            $pamobservacione -> imagen=$archivoImg->getClientOriginalName();
        }

        $pamobservacione -> titulo          = $request->titulo;
        $pamobservacione -> descripcion     = $request->descripcion;
        $pamobservacione -> namepersona        = auth()->user()->name;
        $pamobservacione -> pams_id         = $pam->id;

        $pamobservacione ->save();

        return redirect() -> route('ejecucion.index', $pam);
    }

    public function destroy(Pamobservacione $pamobservacione){
        $pamobservacione->delete();

        return redirect()->route('ejecucion.index', $pamobservacione->pams_id);
    }
}
