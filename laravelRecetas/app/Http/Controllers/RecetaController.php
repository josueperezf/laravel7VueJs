<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Intervention\Image\ImageManager;
//use Intervention\Image;
use Intervention\Image\Facades\Image;
class RecetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['show','buscar']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $recetas = Auth::user()->recetas;
        // $recetas = Receta::where('user_id',auth()->user()->id)->paginate(2);
        // el error que marca es error del editor nada mas
        $recetas = Auth::user()->recetas()->paginate(2);
        $usuario = Auth::user();
        return view('recetas.index', compact('recetas','usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // DB::table('categoria_recetas')->get()->pluck('nombre','id');
        // $categorias = DB::table('categoria_recetas')->get()->pluck('nombre','id');
        //$categorias = CategoriaReceta::all(['nombre','id']);
        $categorias = CategoriaReceta::get()->pluck('nombre','id');
        return view('recetas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|min:6|max:255',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image',
            //'imagen' => 'required|image|size:1000',
        ]);
        // guardar la imagen en storage y obtener la ruta
        $rutaImagen = $request->imagen->store('imagenes-recetas', 'public');
        // cambia el tamaño de la imagen
        // PARA RECORTAR EN LA IMAGEN
        // $image = Image::make(public_path("storage/{$rutaImagen}"))->fit(1200, 550);
        //$image->save();
        // cambair de tama;o
        // http://image.intervention.io/api/resize
        // tiene para hacer de todo en la imagen hasta para cambiar de color
        $image = Image::make(public_path("storage/{$rutaImagen}"))->resize(1200, 550);
        $image->save();
        // opcion 1 para insertar
        /*
        $receta = new Receta;
        $receta->titulo         = $request->titulo;
        $receta->ingredientes   = $request->ingredientes;
        $receta->preparacion    = $request->preparacion;
        $receta->imagen         = $rutaImagen;
        $receta->user_id        = Auth::user()->id;
        $receta->categoria_id   = $request->categoria;
        $receta->save();
        */
        // opcion 2 para insertar
        
        $receta = new Receta;
        $receta->fill($request->all());
        $receta->user_id        = Auth::user()->id;
        $receta->imagen         = $rutaImagen;
        $receta->categoria_id   = $request->categoria;
        $receta->save();
        //opcion 3 para insertar
        // con la opcion 3 esta linea no es necesaria 'user_id'       => Auth::user()->id,
        // el error que marca en receta no es error, es el visual studio que lo marca asi
        /* auth()->user()->recetas()->create([
            'titulo'        => $request->titulo,
            'ingredientes'  => $request->ingredientes,
            'preparacion'   => $request->preparacion,
            'imagen'        => $rutaImagen,
            'categoria_id'  => $request->categoria,
        ]);
        */

        return redirect('recetas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        // obtener  si el usuario actual le ha dado me gusta a la receta
        // en la siguiente linea es un operador ternario, si esta autenticado el usuario
        // usa el auth para buscar la sesion, de alli toma el usuario atenticado, de ese llama al modelo user, metodo megusta,
        // del cual usa metodo laravel llamado contains, este determina si la colección contiene un elemento dado:
        $like = (auth()->user() ) ? auth()->user()->meGusta->contains($receta->id) :false;
        $likes = $receta->likes->count();
        return view('recetas.show', compact('receta','like','likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $this->authorize('view',$receta);
        $categorias = CategoriaReceta::get()->pluck('nombre','id');
        return view('recetas.edit', compact('categorias','receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        // revisa el police para saber si la persona que trata de editar es la que inserto la receta o no
        $this->authorize('update',$receta);
        $data = $request->validate([
            'titulo' => 'required|min:6|max:255',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
        ]);
        // Asignamos valores
        $receta->titulo         = $data['titulo'];
        $receta->categoria_id   = $data['categoria'];
        $receta->preparacion    = $data['preparacion'];
        $receta->ingredientes   = $data['ingredientes'];
        if($request->imagen) {
            $rutaImagen = $request->imagen->store('imagenes-recetas', 'public');
            $image = Image::make(public_path("storage/{$rutaImagen}"))->resize(1200, 550);
            $image->save();
            $receta->imagen   = $rutaImagen;
        }
        $receta->save();
        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        $this->authorize('delete',$receta);
        $receta->delete();
        // return 'eliminando';
        return redirect()->action('RecetaController@index');
    }
    public function buscar(Request $request){
        // $busqueda = $_REQUEST['buscar'];
        $buscar = $request->get('buscar');
        $recetas = Receta::where('titulo','like','%'.$buscar.'%' )->paginate(1);
        // con la siguiente linea se logra que el parametro que llego aca por get, no se pierda al hacer la paginacion
        // a la url le agrega parametro por url, nombre valor
        $recetas->appends(['buscar'=> $buscar]);
        return view('recetas.busqueda', compact('recetas', 'buscar'));
    }
}
