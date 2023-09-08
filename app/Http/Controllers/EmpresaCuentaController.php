<?php

namespace App\Http\Controllers;

use App\Models\Alcance;
use App\Models\Cargo;
use App\Models\Catcuenta;
use App\Models\Collaborator;
use App\Models\Contindiferido;
use App\Models\Cuenta;
use App\Models\Documentation;
use App\Models\Interlocutor;
use App\Models\Pirson;
use App\Models\Quote;
use App\Models\Sede;
use Illuminate\Http\Request;

class EmpresaCuentaController extends Controller
{
    
        //INDEX hace referencial al metodo a mostrar la pagina la principal
        public function index(){
            //return "Bienvenido a la pagina Cuenta Empresa";
    
            //permite mostrar toda la lista de registro
            //$cuentas = Cuenta::all();
            //permite mostrar toda la lista de registro POR PAGINAS
            //$cuentas = Cuenta::where('estado', '=', 0)->paginate();
            $cuentas = Cuenta::paginate(8);
            
            $catcuentas = Catcuenta::all();
    
           //return $cuentas;
            
    
            //redireccionamos a una vista
            return view('empresaCuenta.index', compact('cuentas','catcuentas'));
        }
    
        
    
        public function store(Request $request){
    
            $request->validate([
                'ruc' => 'required|min:11'
            ]);
            
            $cuenta = new Cuenta();
    
            $cuenta -> ruc = $request->ruc;
            $cuenta -> razonSocial = $request->razonSocial;
            $cuenta -> catcuentas_id = $request->catcuentas_id;
    
            $cuenta ->save();
            
    
            return redirect() -> route('cuentas.show', $cuenta->id);
        }
    
        /*UPDATE hace referencia al metodo que se encarga de mostrar el formulario donde se podra 
        ACTUALIZAR O MODIFICAR la informacion Cuentas o Empresas*/
    
        public function update(Request $request, Cuenta $cuenta){
            
            $cuenta -> ruc = $request->ruc;
            $cuenta -> razonSocial = $request->razonSocial;
            $cuenta -> estado = $request->estado;
            $cuenta -> catcuentas_id = $request->catcuentas_id;
    
            $cuenta ->save();
    
            return redirect() -> route('cuentas.show', $cuenta->id);
        }
    
        //SHOW es el metodo que se encargar de mostrar una empresa en particular
        public function show(Cuenta $cuenta){
            
            //SE TIENE QUE DEFINIR ['empresa' => $empresa]); -- EL PARAMETRO QUE SE VA A PASAR PARA QUE LA VISTA PUEDA LEERLO
            //return view('empresaCuenta.show',['empresa' => $empresa]);
    
            //$cuenta = Cuenta::find($id);
            
            $sedes = Sede::paginate();
            $interlocutors = Interlocutor::paginate();
            $documentations = Documentation::paginate();
            $catcuentas = Catcuenta::paginate();
            $alcances = Alcance::all();


            $quotes = Quote::where('cuenta_id',$cuenta->id)->paginate(10);
            $collaborators = Collaborator::where('cuentas_id',$cuenta->id)->get();
            $pirsons = Pirson::all();
            $cargos = Cargo::all();

    
            //OTRAM NAERA DE HACERLO
            //si es que l variables coninciden o son iguales
            return view('empresaCuenta.show',compact('cuenta','catcuentas','sedes',
            'interlocutors','quotes','documentations','alcances','collaborators','pirsons','cargos'));
    
        }
    
        public function destroy(Cuenta $cuenta){
            $cuenta->delete();
    
            return redirect()->route('cuentas.index');
        }
    
}
