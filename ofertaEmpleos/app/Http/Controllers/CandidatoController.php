<?php

namespace App\Http\Controllers;

use App\Candidato;
use App\Vacante;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$vacante_id = $request->vacante_id;
        // la siguiente linea es igual a la anterior
        $vacante_id = $request->route('vacante_id');
        // Obtener los candidatos y vacantes
        $vacante = Vacante::findOrFail($vacante_id);
        $this->authorize('update', $vacante);
        return view('candidatos.index', compact('vacante'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'nombre'=>'required',
            'email'=>'required|email',
            'cv'=>'required|mimes:pdf',
            'vacante_id'=>'required',
        ]);
        $nombreArchivo=null;
        if( $request->file('cv') ) {
            $archivo= $request->file('cv');
            $nombreArchivo= time().'.'.$request->file('cv')->extension();
            $ubicacion = \public_path('/storage/cv');
            $archivo->move($ubicacion,$nombreArchivo);
        }
        $vacante = Vacante::find($data['vacante_id']);
        $vacante->candidatos()->create([
            'nombre'=>$data['nombre'],
            'email'=>$data['email'],
            'cv'=>$nombreArchivo,
            'vacante_id'=>$data['vacante_id']
        ]);
        // $candidato->save();
        $reclutador = $vacante->reclutador;
        $reclutador->notify(new \App\Notifications\NuevoCandidato($vacante->titulo, $vacante->id));
        return back()->with('estado','Tus datos se enviaron Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function show(Candidato $candidato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidato $candidato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidato $candidato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidato $candidato)
    {
        //
    }
}
