<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['show']]);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(3);
        return view('perfiles.show', compact('perfil','recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        $this->authorize('view',$perfil);
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        $this->authorize('update',$perfil);
        $request->validate([
            'nombre' => 'required|min:6|max:255',
            'url' => 'required',
            'biografia' => 'required',
            // 'imagen' => 'required|image|size:1000',
        ]);
        auth()->user()->url= $request->url;
        auth()->user()->name= $request->nombre;
        auth()->user()->save();
        $dataPerfil=[ 'biografia'=> $request->biografia];
        if($request->imagen) {
            $rutaImagen = $request->imagen->store('imagenes-perfiles', 'public');
            $image = Image::make(public_path("storage/{$rutaImagen}"))->resize(600, 600);
            $image->save();
            $dataPerfil['imagen'] = $rutaImagen;
        }
        auth()->user()->perfil()->update($dataPerfil);
        return redirect()->action('RecetaController@index');
    }

}
