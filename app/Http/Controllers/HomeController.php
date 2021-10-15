<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('contenido/contenido');
    }

    public function listUsuarios(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $usuarios= Authenticatable::all();
        return $usuarios;
    }
}
