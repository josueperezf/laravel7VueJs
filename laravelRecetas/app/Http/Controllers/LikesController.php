<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function update(Request $request, Receta $receta)
    {
        // almacena los likes del usuario autenticado a una receta
        // toggle lo que hace es que si tiene me gusta se lo quita, y si no se lo pone, es de laravel como tal
        if(auth()->user()) {
            return auth()->user()->meGusta()->toggle($receta);
        }
    }
}
