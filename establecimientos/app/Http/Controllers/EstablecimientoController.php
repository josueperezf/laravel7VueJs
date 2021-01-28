<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Establecimiento;
use PhpParser\Node\Stmt\Return_;
use Intervention\Image\Facades\Image;

class EstablecimientoController extends Controller
{

    public function create()
    {
        $categorias = Categoria::all();
        return view('establecimientos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'            =>'required|min:3',
            'imagen_principal'  =>'required|image|max:1000',
            'direccion'         =>'required',
            'latitud'           =>'required',
            'longitud'          =>'required',
            'telefono'          =>'required|numeric',
            'descripcion'       =>'required|min:3',
            'apertura'          =>'required|date_format:H:i',
            'cierre'            =>'required|date_format:H:i|after:apertura',
            'uuid'              =>'required|uuid',
            //'categoria_id'      =>'exists:Categorias,id',
            'categoria_id' => 'required|exists:App\Models\Categoria,id'
        ]);
        $ruta_imagen = $request->file('imagen_principal')->store('principales', 'public');
        $img = Image::make(public_path("storage/{$ruta_imagen}"));
        $img->save();
        $establecimiento = new Establecimiento;
        $establecimiento->fill($request->all());
        $establecimiento->user_id=auth()->user()->id;
        $establecimiento->imagen_principal=$ruta_imagen;
        $establecimiento->save();
        //return redirect()->action('EstablecimientoController@index')->with('estado','Tu informacion se almaceno correctamente');
        return back()->with('estado','Tu informacion se almaceno correctamente');

    }
    public function show(Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Establecimiento $establecimiento)
    {
        $categorias = Categoria::all();
        // la siguiente linea es para que traiga el ultimo establecimiento registado por esa persona
        // la clausula dice que una persona solo debe registrar un unico establecimiento, por ende, la siguiente consulta traeria un valor valido
        $establecimiento = auth()->user()->establecimientos->last();
        $imagenes = Imagen::where('id_establecimiento',$establecimiento->uuid)->get();
        return view('establecimientos.edit', compact('categorias','establecimiento','imagenes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establecimiento $establecimiento)
    {
        // establecimientoPolicy
        $this->authorize('update', $establecimiento );
        // en la validacion de imagen le quite el required en comparacion con el metodo store, ya que de esta manera permito que venga vacio, y si tiene dato lo valide que sea imagen y que no pese mas de 1 mega
        $data = $request->validate([
            'nombre'            =>'required|min:3',
            'imagen_principal'  =>'image|max:1000',
            'direccion'         =>'required',
            'latitud'           =>'required',
            'longitud'          =>'required',
            'telefono'          =>'required|numeric',
            'descripcion'       =>'required|min:3',
            'apertura'          =>'required|date_format:H:i',
            'cierre'            =>'required|date_format:H:i|after:apertura',
            'uuid'              =>'required|uuid',
            //'categoria_id'      =>'exists:Categorias,id',
            'categoria_id' => 'required|exists:App\Models\Categoria,id'
        ]);
        $establecimiento->nombre        = $data['nombre'];
        $establecimiento->direccion     = $data['direccion'];
        $establecimiento->latitud       = $data['latitud'];
        $establecimiento->longitud      = $data['longitud'];
        $establecimiento->telefono      = $data['telefono'];
        $establecimiento->descripcion   = $data['descripcion'];
        $establecimiento->apertura      = $data['apertura'];
        $establecimiento->cierre        = $data['cierre'];
        $establecimiento->uuid          = $data['uuid'];
        $establecimiento->categoria_id  = $data['categoria_id'];
        if(request('imagen_principal')) {
            $ruta_imagen = $request->file('imagen_principal')->store('principales', 'public');
            $img = Image::make(public_path("storage/{$ruta_imagen}"));
            $img->save();
            $establecimiento->imagen_principal=$ruta_imagen;
        }
        $establecimiento->save();
        return back()->with('estado','TU ESTABLECIMIENTO SE MODIFICO CORRECTAMENTE');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establecimiento $establecimiento)
    {
        //
    }
}
