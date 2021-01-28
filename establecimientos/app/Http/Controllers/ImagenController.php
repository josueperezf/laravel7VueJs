<?php

namespace App\Http\Controllers;

use App\Models\Establecimiento;
use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        // composer require intervention/image
        // leer la imagen
        // php artisan list
        // php artisan storage:link para poder almacenar en storage
        // si se necesita almacenar la imagen en otro lugar ejemplo amazon web services se colocaria donde esta la palabra public
        $ruta_imagen = $request->file('file')->store('establecimientos', 'public');
        $imagen = Image::make(public_path("storage/{$ruta_imagen}"));
        $imagen->fit(600, 600);
        $imagen->save();
        // almacenar con modelo
        $imagenBD= new Imagen;
        $imagenBD->id_establecimiento=$request->uuid;
        $imagenBD->ruta_imagen=$ruta_imagen;
        $imagenBD->save();
        $respuesta=[
            'archivo'=> $ruta_imagen
        ];
        return response()->json($respuesta);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function show(Imagen $imagen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function edit(Imagen $imagen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Imagen $imagen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        /** inicio de seccion para que solo pueda eliminar la imagen quien creo el  establecimiento*/
        $uuid = $request->uuid;
        $establecimiento = Establecimiento::where('uuid',$uuid)->first();
        // establecimientoPolicy
        $this->authorize('delete', $establecimiento );
        /** fin de seccion para que solo pueda eliminar la imagen quien creo el  establecimiento*/
        $imagen = $request->get('imagen');
        $estatusRespuesta = 200;
        $mensaje = 'Imagen Eliminada';
        if(File::exists('storage/'.$imagen)) {
            if(!File::delete('storage/'.$imagen)) {
                $mensaje ='No se ha podido eliminar';
                $estatusRespuesta = 403;
            }else{
                Imagen::where(['ruta_imagen'=>$imagen])->delete();
            }
        } else {
            $mensaje ='Imagen no encontrada';
            $estatusRespuesta = 404;
        }
        $respuesta = [
            'mensaje'   =>$mensaje,
            'imagen'    =>$imagen,
            'uuid'      =>$uuid,
        ];
        return  response()->json($respuesta, $estatusRespuesta);
    }
}
