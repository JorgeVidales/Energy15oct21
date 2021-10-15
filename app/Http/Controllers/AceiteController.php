<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aceite;

class AceiteController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $aceites= Aceite::all();
        return $aceites;
    }

    public function selectAceite(Request $request){
        // if (!$request->ajax()) return redirect('/');

        $aceites = Aceite::select('id', 'modelo')->orderBy('id', 'asc')->get();

        return ['aceites' => $aceites];
    }

    public function reportePDF(){

        // $data = "ESPECTROMETRÍA  DE METALES  [< 5.0 micras]";  reporteAguaGlicolPdf
        $data = 'ESPECTROMETRÍA DE METALES [ < 5.0 micras]';
        
        // $pdf = \PDF::loadView('pdf.reportespdf', ['data' => $data])->setPaper('a4', 'landscape');
        $pdf = \PDF::loadView('pdf.reporteAguaGlicolPdf', ['data' => $data])->setPaper('a4', 'landscape');
                // ->set_option('font-family', 'Tahoma');
        return $pdf->download('prueba_PDF.pdf');

        // $pdf = PDF::loadView('pdf.reportespdf');
        // return $pdf->download('pruebaPDF.pdf');

    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $aceites = new Aceite();
        // $aceites->tipoAceite = $request->tipoAceite;
        // $aceites->marca = $request->marca;
        // $aceites->modelo = $request->modelo;

        $aceites->tipoAceite = $request->tipoAceite;
        $aceites->marca = $request->marca;
        $aceites->modelo = $request->modelo;
        $aceites->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $aceites = Aceite::findOrFail($request->id);
        $aceites->tipoAceite = $request->tipoAceite;
        $aceites->marca = $request->marca;
        $aceites->modelo = $request->modelo;
        $aceites->save();
    }
}
