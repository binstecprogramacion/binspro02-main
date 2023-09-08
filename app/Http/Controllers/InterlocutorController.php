<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Interlocutor;
use Illuminate\Http\Request;

class InterlocutorController extends Controller
{
    
    public function store(Request $request , Cuenta $cuenta){

        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'correo' => 'required',
            'telefono' => 'required'
        ]);
        
        $interlocutor = new Interlocutor();

        $interlocutor -> nombre = $request->nombre;
        $interlocutor -> apellidos = $request->apellidos;
        $interlocutor -> correo = $request->correo;
        $interlocutor -> telefono = $request->telefono;
        $interlocutor -> descripcion = $request->descripcion;
        $interlocutor -> cuenta_id = $cuenta->id;

        $interlocutor ->save();

        return redirect() -> route('cuentas.show', $cuenta->id);
        
    }

    public function update(Request $request ,Interlocutor $interlocutor ){
        
        
        $interlocutor -> nombre = $request->nombre;
        $interlocutor -> apellidos = $request->apellidos;
        $interlocutor -> correo = $request->correo;
        $interlocutor -> telefono = $request->telefono;
        $interlocutor -> descripcion = $request->descripcion;

        $interlocutor ->save();

        return redirect() -> route('cuentas.show', $interlocutor->cuenta_id);
        

    }

    public function destroy(Interlocutor $interlocutor){
        $interlocutor->delete();

        return redirect() -> route('cuentas.show', $interlocutor->cuenta_id);

        
    }

}
