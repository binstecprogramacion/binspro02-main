<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Contindiferido;
use App\Models\Cuenta;
use App\Models\Htcategoria;
use App\Models\Omologado;
use App\Models\Pirson;
use App\Models\Proveedo;
use App\Models\Reqobservaciones;
use App\Models\Requerimiento;
use App\Models\Sede;
use App\Models\Solicitubiene;
use App\Models\Solicitudservreque;
use App\Models\User;
use Illuminate\Http\Request;

class RequerimientoController extends Controller
{

    public function index(){

        $cuentas = Cuenta::all();
        $sedes = Sede::all();


        return view('Requerimiento.index', compact('cuentas','sedes'));

    }


    public function store(Request $request){
    
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'cuentas_id' => 'required',
            'sedes_id' => 'required'
        ]);
        
        $requerimiento = new Requerimiento();

        $requerimiento -> titulo        = $request->titulo;
        $requerimiento -> descripcion   = $request->descripcion;
        $requerimiento -> cuentas_id    = $request->cuentas_id;
        $requerimiento -> sedes_id      = $request->sedes_id;

        if ($request->hasFile('imagen')) {
            $archivoImg=$request->file('imagen');
            $archivoImg->move(public_path().'/ImagenesRequerimiento/',$archivoImg->getClientOriginalName());
            $requerimiento -> imagen = $archivoImg->getClientOriginalName();
        }


        $requerimiento -> estado = "abierto";

        $cuentas = Cuenta::where('id',$request->cuentas_id)->get();

        foreach ($cuentas as $cuenta) {
            $categoriaCuenta = $cuenta->catcuentas_id;
        };

        if ($categoriaCuenta == 1) {
            $requerimiento -> tipo_servicio     = "PROPERTY";
            $requerimiento -> tipo_area         = "AREA COMUN";
        }elseif ($categoriaCuenta == 2) {
            $requerimiento -> tipo_servicio     = "FACILITY";
            $requerimiento -> tipo_area         = "AREA INTERNA";
        };

        $requerimiento -> users_id = auth()->user()->id;


        $requerimiento ->save();
        

        return redirect()->route('requerimiento.show');
    }


    public function show(){

        $requerimientos = Requerimiento::paginate(10);
        $cuentas = Cuenta::all();



        return view('Requerimiento.show',compact('requerimientos','cuentas'));

    }

    public function ejecucionReq(Requerimiento $requerimiento){

        $cuentas = Cuenta::where('id',$requerimiento->cuentas_id)->get();
        $sedes = Sede::where('id',$requerimiento->sedes_id)->get();
        $htcategorias = Htcategoria::all();
        $users = User::where('id',$requerimiento->users_id)->get();
        $sedes = Sede::where('id',$requerimiento->sedes_id)->get();
        $omologados = Omologado::where('alcances_id',$sedes[0]->alcances_id)->get();

        $omologadosFiltra = [];

        foreach ($omologados as $omologado) {
            if ($omologado->htcategorias_id == $requerimiento->htcategorias_id) {
                $omologadosFiltra[] = $omologado;
            }
        }
        

        $proveedos = Proveedo::all();
        $contindiferidos = Contindiferido::where('cuentas_id',$requerimiento->cuentas_id)->get();
        $reqobservaciones = Reqobservaciones::where('requerimientos_id',$requerimiento->id)->get();
        $collaborators = Collaborator::where('cuentas_id',$requerimiento->cuentas_id)->get();

        $CollaboFiltra = [];

        foreach ($collaborators as $collaborator) {
            if ($collaborator->cargos_id == 1) {
                $CollaboFiltra[] = $collaborator;
            }
        }

        $pirsons = Pirson::all();


        $solicitudservreques = Solicitudservreque::where('requerimientos_id',$requerimiento->id)->get();
        $estados = array(
            array("id" => 1, "estado" => "Pendiente validacion"),
            array("id" => 2, "estado" => "Aprobado"),
            array("id" => 3, "estado" => "Realizado"),
            array("id" => 4, "estado" => "Cancelado")
          );

        
        $solicitubienes = Solicitubiene::where('requerimientos_id',$requerimiento->id)->get();
    

        return view('Requerimiento.ejecucion',
        compact('requerimiento','cuentas','sedes','htcategorias',
        'users','omologadosFiltra','proveedos','contindiferidos',
        'reqobservaciones','CollaboFiltra','pirsons','solicitudservreques',
        'estados','solicitubienes'));

    }

    public function destroy(Requerimiento $requerimiento){

        $requerimiento->delete();

        return redirect()->route('requerimiento.show');
    }

    public function update(Request $request , Requerimiento $requerimiento){
    
        $request->validate([
            'htcategorias_id' => 'required',
            'asignacion' => 'required'
        ]);
        

        $solicitudservreques = Solicitudservreque::where('requerimientos_id',$requerimiento->id)->get();
        $solicitubienes = Solicitubiene::where('requerimientos_id',$requerimiento->id)->get();

        //Comentario: Al momento de editar la asignacion al requerimiento, se elimina la solicitud de serv o solicitud de biene
            if ( 1 == $request->asignacion ) {
                
                foreach ($solicitudservreques as $solicitudservreque) {
                    $solicitudservreque->delete();
                }
            }

            if ( 2 == $request->asignacion ) {
                
                foreach ($solicitubienes as $solicitubiene) {
                    $solicitubiene->delete();
                }
            }
        

        $requerimiento -> htcategorias_id  = $request->htcategorias_id;
        $requerimiento -> asignacion  = $request->asignacion;

        $requerimiento ->save();
        

        return redirect()->route('requerimiento.ejecucionReq' , $requerimiento->id );
    }

}
