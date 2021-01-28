<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function show(CategoriaReceta $categoriaReceta) {
        $recetas =  $categoriaReceta->recetas()->paginate(1);
        // return $recetas;
        return view('categorias.show',compact('recetas','categoriaReceta'));
    }
}
