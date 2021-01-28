<?php

namespace App\Http\Controllers;

use App\Ubicacion;
use App\Vacante;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // latest trae las vacantes mas recientes
        $vacantes = Vacante::latest()->where('activa', '=', 1)->take(10)->get();
        $ubicacions = Ubicacion::all();
        return view('inicio.index', compact('vacantes','ubicacions'));
    }
}
