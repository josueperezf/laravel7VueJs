<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index() {
        // receta con mas botos 
        // la siguientes linea trae las recetas que tengan las de un like, has es metodo laravel
        // $votadas = Receta::has('likes','>',0)->get();
        // la siguiente linea cuenta cuantos likes tiene cada receta, al objeto retornado de receta le agrega una columna con el nombre del metodo consultado,
        // concatenandole la palabra count, en este caso seria likes_count, traemos los ultimos 3 y con esos tenemos las recetas mas botadas con mas likes
        $votadas = Receta::withCount('likes')->orderBy('likes_count','desc')->take(3)->get();
        // return $votadas;
        // $nuevas = Receta::orderBy('created_at', 'DESC')->get();
        // latest  es un metodo de laravel que trae la data con or order by desc por el campo created, puede ser porotro comp paramtro
        $nuevas = Receta::latest()->limit(5)->get();
        $categorias = CategoriaReceta::all();
        $recetas = [];
        foreach ($categorias as $categoria) {
            $recetas[ Str::slug($categoria->nombre)][]=Receta::where('categoria_id',$categoria->id)->limit(3)->get();
        }
        return view('inicio.index', compact('nuevas', 'recetas', 'votadas'));
    }
}
