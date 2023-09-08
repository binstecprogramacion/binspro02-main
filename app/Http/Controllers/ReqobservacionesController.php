<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

use App\Models\Reqobservaciones;
use App\Models\Requerimiento;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;


class ReqobservacionesController extends Controller
{
    public function store(Request $request, Requerimiento $requerimiento){
        
        $request->validate([
            'titulo'    => 'required',
            'descripcion'    => 'required',
            'imagen'    => 'image'

        ]);

        $imagen = $request->file('imagen')->store('public/imagenObcReq');

        $url = Storage::url($imagen);

        

        $reqobservaciones = new Reqobservaciones();


        /*-- 
        if ($request->hasFile('imagen')) {
            $archivoImg=$request->file('imagen');
            $archivoImg->move(public_path().'/imagenObcReq/',$archivoImg->getClientOriginalName());
            $reqobservaciones -> imagen=$archivoImg->getClientOriginalName();
        }
        */

        $reqobservaciones -> imagen             = $url;

        $reqobservaciones -> titulo             = $request->titulo;
        $reqobservaciones -> descripcion        = $request->descripcion;
        $reqobservaciones -> namepersona        = auth()->user()->name;
        $reqobservaciones -> requerimientos_id  = $requerimiento->id;

        

        $reqobservaciones ->save();

        return redirect() -> route('requerimiento.ejecucionReq' , $requerimiento->id );
    }

    public function destroy(Reqobservaciones $reqobservacione){

        $urlimg = str_replace('storage','public',$reqobservacione -> imagen); 

        Storage::delete($urlimg);
        
        $reqobservacione->delete();

        return redirect()->route('requerimiento.ejecucionReq', $reqobservacione->requerimientos_id);
    }
}
