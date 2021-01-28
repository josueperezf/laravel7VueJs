@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" />
@endsection
@section('navegacion')
    @include('ui.categoriasnav')
@endsection
@section('content')
    <h1 class="text-3xl text-center mt-10">{{$vacante->titulo}} </h1>
    <div class="mt-10 mb-20 md:flex items-start">
        <div class="md:w-3/5">
            <p class="block text-gray-700 font-bold my-5">
                Publicado: <span class="font-normal"> {{$vacante->created_at->diffForHumans()}}</span>
                Por: <span class="font-normal"> {{$vacante->reclutador->name}}</span>
            </p>
            <p class="block text-gray-700 font-bold my-5">
                Categoria: <span class="font-normal"> {{$vacante->categoria->nombre}}</span>
            </p>
            <p class="block text-gray-700 font-bold my-5">
                Salario: <span class="font-normal"> {{$vacante->salario->monto}}</span>
            </p>
            <p class="block text-gray-700 font-bold my-5">
                Ubicacion: <span class="font-normal"> {{$vacante->ubicacion->nombre}}</span>
            </p>
            <p class="block text-gray-700 font-bold my-5">
                Experiencia: <span class="font-normal"> {{$vacante->experiencia->nombre}}</span>
            </p>
            <h2 class="text-2xl text-center mt-10 text-gray-700 mb-5">Conocimientos y tecnologias</h2>
            @php
                $habilidades = explode(',',$vacante->habilidades);
            @endphp
            @foreach ($habilidades as $habilidad)
                <p class="inline-block border rounded py-2 px-8 text-gray-700  my-2">
                    {{$habilidad}}
                </p>
            @endforeach
            <!-- npm install lightbox2 --save -->
            <!-- https://lokeshdhakar.com/projects/lightbox2/  -->
            <!--
                agregar en el archivo app.js
                    require('lightbox2');
                en webpack.mix.js
            -->
            <a href="/storage/vacantes/{{$vacante->imagen}}" data-lightbox='imagen'  data-title="Vacante {{$vacante->titulo}}" >
                <img src="/storage/vacantes/{{$vacante->imagen}}" alt="" class="w-40 mt-10">
            </a>
            <div class="descripcion mt-10 mb-5">
                {!! $vacante->descripcion !!}
            </div>
        </div>
        @if ($cavante->activa===1)
            @include('ui.contacto')
        @endif
    </div>
@endsection
