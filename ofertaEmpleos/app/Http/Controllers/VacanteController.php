<?php

namespace App\Http\Controllers;

use App\Salario;
use App\Vacante;
use App\Categoria;
use App\Ubicacion;
use App\Experiencia;
use App\Policies\VacantePolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }
    public function index()
    {
        // simplepaginate(3) es igual a paginate(3), con la diferencia que no trae clases boostrap por default
        $vacantes = auth()->user()->vacantes()->latest()->simplepaginate(10);
        // dd($vacantes);
        return view('vacantes.index', compact('vacantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        $experiencias = Experiencia::all();
        $ubicacions = Ubicacion::all();
        $salarios = Salario::all();
        return view('vacantes.create', compact('categorias','experiencias','ubicacions','salarios'));
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
            'titulo'=>'required|min:8',
            'categoria'=>'required',
            'experiencia'=>'required',
            'ubicacion'=>'required',
            'salario'=>'required',
            'descripcion'=>'required|min:20',
            'imagen'=>'required',
            'habilidades'=>'required',
            // habilidades es skills
        ]);
        $vacante = auth()->user()->vacantes()->create([
            "titulo" => $data['titulo'],
            "imagen" => $data['imagen'],
            "descripcion" => $data['descripcion'],
            "habilidades" => $data['habilidades'],
            "categoria_id" => $data['categoria'],
            "experiencia_id" => $data['experiencia'],
            "ubicacion_id" => $data['ubicacion'],
            "salario_id" => $data['salario']
        ]);
        $vacante->save();
        return redirect()->action('VacanteController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante)
    {
        if ($vacante->activa ===0) {
            return abort(404);
        }
        return view('vacantes.show', compact('vacante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacante $vacante)
    {
        $this->authorize('view', $vacante);
        $categorias = Categoria::all();
        $experiencias = Experiencia::all();
        $ubicacions = Ubicacion::all();
        $salarios = Salario::all();
        return view('vacantes.edit', compact('vacante','categorias','experiencias','ubicacions','salarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacante $vacante)
    {
        $this->authorize('update', $vacante);
        $data = $request->validate([
            'titulo'=>'required|min:8',
            'categoria'=>'required',
            'experiencia'=>'required',
            'ubicacion'=>'required',
            'salario'=>'required',
            'descripcion'=>'required|min:20',
            'imagen'=>'required',
            'habilidades'=>'required',
            // habilidades es skills
        ]);
        $vacante->titulo = $data['titulo'];
        $vacante->imagen = $data['imagen'];
        $vacante->descripcion = $data['descripcion'];
        $vacante->habilidades = $data['habilidades'];
        $vacante->categoria_id = $data['categoria'];
        $vacante->experiencia_id = $data['experiencia'];
        $vacante->ubicacion_id = $data['ubicacion'];
        $vacante->salario_id = $data['salario'];
        $vacante->save();
        return redirect()->action('VacanteController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Vacante $vacante)
    {
        $this->authorize('delete', $vacante);
        if($request->ajax()){
            $vacante->delete();
            return response()->json(['mensaje'=>'Se elimino la vacante '.$vacante->titulo]);
        }
    }
    public function imagen(Request $request)
    {
        $imagen = $request->file('file');
        $nombreImagen = time().'.'.$imagen->extension();
        $imagen->move(\public_path('storage/vacantes'),$nombreImagen);
        return response()->json(['correcto'=>$nombreImagen]);
        //http_response_code(415);
        //00die('size is invalid');
    }
    public function borrarimagen(Request $request)
    {
        if($request->ajax()){
            $imagen = $request->get('imagen');
            if(File::exists('storage/vacantes/'.$imagen)) {
                if(File::delete('storage/vacantes/'.$imagen)) {
                    return response('Imagen Eliminada',200);
                }else{
                    return response('No se ha podido eliminar',403);
                }
            }else{
                return response('Imagen no encontrada',404);
            }
        }
    }
    // cambia el estado de una vacante
    public function cambiarEstado(Request $request, Vacante $vacante) {

        $vacante->activa= $request->estado;
        $vacante->save();
        return response()->json(['respuesta'=>'Correcto']);
    }
    public function buscar(Request $request){
        $data= $request->validate([
            'categoria'=>'required',
            'ubicacion'=>'required',
        ]);
        $categoria_id = $data['categoria'];
        $ubicacion_id = $data['ubicacion'];
        $vacantes = Vacante::latest()
                        ->where('categoria_id',$categoria_id)
                        ->where('ubicacion_id',$ubicacion_id)
                        ->get();
        return view('buscar.index', compact('vacantes'));
    }
    public function resultados(Request $request){

    }
}
