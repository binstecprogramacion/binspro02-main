<?php

namespace App\Http\Controllers;

use App\Models\Alcance;
use Illuminate\Http\Request;

class AlcanceController extends Controller
{
    public function index(){

        $alcances = Alcance::paginate(6);

        return view('alcance.index', compact('alcances'));

    }

    public function store(Request $request){

        $request->validate([
            'provincia' => 'required'
        ]);
        
        $alcance = new Alcance();

        $alcance -> provincia = $request->provincia;

        $alcance ->save();

        return redirect() -> route('alcances.index');
    }

    public function update(Request $request, Alcance $alcance){
        
        $alcance -> provincia = $request->provincia;

        $alcance ->save();

        return redirect() -> route('alcances.index');
    }

    

    public function destroy(Alcance $alcance){
        $alcance->delete();

        return redirect()->route('alcances.index');
    }
}
