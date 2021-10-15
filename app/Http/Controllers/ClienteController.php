<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cliente= Cliente::all();
        return $cliente;
    }

    public function selectCliente(Request $request){
        if (!$request->ajax()) return redirect('/');

        $cliente = Cliente::where('condicion', '=' , '1')
        ->select('id','compania')->orderBy('compania', 'asc')->get();

        return ['cliente' => $cliente];
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cliente = new Cliente();
        $cliente->compania = $request->compania;
        $cliente->condicion = '1';
        $cliente->save();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cliente = Cliente::findOrFail($request->id);
        $cliente->compania = $request->compania;
        $cliente->condicion = '1';
        $cliente->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cliente = Cliente::findOrFail($request->id);
        $cliente->condicion = '0';
        $cliente->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $cliente = Cliente::findOrFail($request->id);
        $cliente->condicion = '1';
        $cliente->save();
    }
}
