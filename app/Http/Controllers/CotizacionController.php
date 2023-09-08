<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CotizacionController extends Controller
{

    public function store(Request $request , Cuenta $cuenta){

        $request->validate([
            'nombreCotCon' => 'required',
            'documentation_id' => 'required',
            'anioCotCon' => 'required',
            'pdfDoc' => 'required'
        ]);
        
        $quote = new Quote();

        $quote -> nombreCotCon = $request->nombreCotCon;
        
        if ($request->hasFile('pdfDoc')) {
            $archivo=$request->file('pdfDoc');
            $archivo->move(public_path().'/Archivos/',$archivo->getClientOriginalName());
            $quote -> pdfDoc=$archivo->getClientOriginalName();
        }
        
        $quote -> cuenta_id = $cuenta->id;
        $quote -> documentation_id = $request->documentation_id;
        $quote -> anioCotCon = $request->anioCotCon;
        

        $quote ->save();

        return redirect() -> route('cuentas.show', $cuenta->id);
    }


    public function update(Request $request ,Quote $quote ){
        
        
        $quote -> nombreCotCon = $request->nombreCotCon;
        if ($request->hasFile('pdfDoc')) {
            $archivo=$request->file('pdfDoc');
            $archivo->move(public_path().'/Archivos/',$archivo->getClientOriginalName());
            $quote -> pdfDoc=$archivo->getClientOriginalName();
        }
        $quote -> documentation_id = $request->documentation_id;
        $quote -> anioCotCon = $request->anioCotCon;

        $quote ->save();

        return redirect() -> route('cuentas.show', $quote->cuenta_id);
        

    }

    public function destroy(Quote $quote){
        $quote->delete();

        return redirect() -> route('cuentas.show', $quote->cuenta_id);

        
    }
}
