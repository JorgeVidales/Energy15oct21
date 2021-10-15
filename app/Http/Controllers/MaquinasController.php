<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maquinas;

class MaquinasController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $maquina = Maquinas::join('aceites','maquinas.idaceite','=','aceites.id')
        ->select('maquinas.id','maquinas.idaceite','maquinas.tipo','maquinas.marca', 'maquinas.modelo','aceites.modelo as AceiteMod','maquinas.tag','maquinas.volaceite',)
        ->get();

        // $maquina= Maquinas::all(); 
        return $maquina;
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $maquina = new Maquinas();
        $maquina->idaceite = $request->idaceite;
        $maquina->tipo = $request->tipo;
        $maquina->marca = $request->marca;
        $maquina->modelo = $request->modelo;
        $maquina->tag = $request->tag;
        $maquina->volaceite = $request->volaceite;
        $maquina->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $maquina = Maquinas::findOrFail($request->id);
        $maquina->idaceite = $request->idaceite;
        $maquina->tipo = $request->tipo;
        $maquina->marca = $request->marca;
        $maquina->modelo = $request->modelo;
        $maquina->tag = $request->tag;
        $maquina->volaceite = $request->volaceite;
        $maquina->save();
    }
}
