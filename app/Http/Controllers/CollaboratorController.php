<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Cuenta;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    

    public function store(Request $request, Cuenta $cuenta){
        
        
        $request->validate([
            'pirsons_id'   => 'required',
            'cargos_id'    => 'required'
        ]);
        
        
        $collaborator = new Collaborator();

        $collaborator -> pirsons_id      = $request->pirsons_id;
        $collaborator -> cargos_id       = $request->cargos_id;
        $collaborator -> cuentas_id   = $cuenta->id;

        $collaborator ->save();

        return redirect() -> route('cuentas.show', $collaborator -> cuentas_id);
    }

    public function update(Request $request, Collaborator $collaborator){

        $request->validate([
            'pirsons_id'   => 'required',
            'cargos_id'    => 'required'
        ]);
        

        $collaborator -> pirsons_id      = $request->pirsons_id;
        $collaborator -> cargos_id       = $request->cargos_id;

        $collaborator ->save();

        return redirect() -> route('cuentas.show', $collaborator -> cuentas_id);
    }

    public function destroy(Collaborator $collaborator){
        
        $collaborator->delete();

        return redirect() -> route('cuentas.show', $collaborator -> cuentas_id);
    }
}
