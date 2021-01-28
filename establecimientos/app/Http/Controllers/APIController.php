<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Establecimiento;
use App\Models\Imagen;
use Illuminate\Http\Request;

class APIController extends Controller
{
    // retorna todos los establecimientos
    public function index(){

        // $establecimientos = Establecimiento::all();
        // como establecimiento tiene una relacion con categoria en el modelo de establecimiento,
        // entonces podemos usa 'with' que es parte de laravel eager loading para obtener ademnas de los establecimientos, las categorias relacionadas
        $establecimientos = Establecimiento::with('categoria')->get();
        return response()->json($establecimientos);
    }
    //Metodo para obtener todas las categorias
    public function categorias(){
        $categorias = Categoria::all();
        return response()->json($categorias);
    }
    public function categoria(Categoria $categoria){
        // se creo un metodo en el modelo llamado getRouteKeyName, con el cual hace que busque por el slug y no por el id
        // return $establecimientos=
        // $categoria->establecimientos;
        //return response()->json($categoria);
        // https://www.udemy.com/course/curso-laravel-crea-aplicaciones-y-sitios-web-con-php-y-mvc/learn/lecture/20333267#overview
        $establecimiento = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->take(3)->get();
        return response()->json($establecimiento);
    }
    public function show(Establecimiento $establecimiento){
        $imagenes = Imagen::where('id_establecimiento',$establecimiento->uuid)->get();
        $establecimiento->imagenes=$imagenes;
        return response()->json($establecimiento);
    }
    public function todosLosEstablecimientosPorCategoria(Categoria $categoria) {
        $establecimiento = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->get();
        return response()->json($establecimiento);
    }
}
