<?php

namespace App\Http\Controllers;

use App\Models\Documentation;
use Illuminate\Http\Request;

class DocumentacionController extends Controller
{
    public function index(){

        $documentations = Documentation::all();

        return view('categoriaDocumentacion.index', compact('documentations'));

    }

    public function store(Request $request){

        $request->validate([
            'nombreCatgDoc' => 'required',
            'descCatg' => 'required'
        ]);
        
        $documentations = new Documentation();

        $documentations -> nombreCatgDoc = $request->nombreCatgDoc;
        $documentations -> descCatg = $request->descCatg;

        $documentations ->save();

        return redirect()->route('documentations.index');
    }

    public function update(Request $request, Documentation $documentation){

        $request->validate([
            'nombreCatgDoc' => 'required',
            'descCatg' => 'required'
        ]);
        
        $documentation -> nombreCatgDoc = $request->nombreCatgDoc;
        $documentation -> descCatg = $request->descCatg;

        $documentation ->save();

        return redirect()->route('documentations.index');
    }

    public function destroy(Documentation $documentation){
        $documentation->delete();
        return redirect()->route('documentations.index');
    }

}
