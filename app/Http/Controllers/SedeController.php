<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Sede;
use Illuminate\Http\Request;

class SedeController extends Controller
{
    
    //INDEX hace referencial al metodo a mostrar la pagina la principal
    public function index(){
        return "Bienvenido a la pagina Sede";
    }

    /*CREATE hace referencia al metodo que se encarga de mostrar el formulario
    donde se podra crear o registrar nuevas Cuentas o Empresas*/
    public function create(){
        return "Bienvenido a la pagina para agregar una nueva Sede";
    }

    public function store(Request $request , Cuenta $cuenta){

        $request->validate([
            'nomSede' => 'required',
            'direccion' => 'required',
            'metraje' => 'required',
            'alcances_id' => 'required'

            
        ]);

        
        $sede = new Sede();

        $sede -> nomSede = $request->nomSede;
        $sede -> direccion = $request->direccion;
        $sede -> metraje = $request->metraje;
        $sede -> alcances_id = $request->alcances_id;
        $sede -> cuenta_id = $cuenta->id;

        $sede ->save();

        return redirect() -> route('cuentas.show', $cuenta->id);
        
    }

    
    public function update(Request $request ,Sede $sede ){
        
        
        $sede -> nomSede = $request->nomSede;
        $sede -> direccion = $request->direccion;
        $sede -> alcances_id = $request->alcances_id;
        $sede -> metraje = $request->metraje;

        $sede ->save();

        return redirect() -> route('cuentas.show', $sede->cuenta_id);
        

    }

    public function show(){
        
        
        $sedes = Sede::paginate();

        return view('empresaCuenta.show',compact('sedes'));

    }

    public function destroy(Sede $sede){
        $sede->delete();

        return redirect() -> route('cuentas.show', $sede->cuenta_id);

        
    }
}
