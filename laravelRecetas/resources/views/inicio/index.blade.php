@extends('layouts.app')
@section('styles')
    <!-- el css se busco en la https://cdnjs.com/libraries/  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />    
@endsection
@section('hero')
    <div class="hero-categorias">
        <form action="{{route('recetas.buscar')}}" class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto buscar">
                    <p class="display-4">Encuentra una receta para tu proxima comida</p>
                    <input type="search" name="buscar" id="buscar" class="form-control" placeholder="Buscar Receta">
                </div>
            </div>
        </form>
    </div>
@endsection
@section('content')

<!-- https://owlcarousel2.github.io/OwlCarousel2/ -->
    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mb-4">Ultimas Recetas</h2>
        <div class="owl-carousel owl-theme">
            @foreach ($nuevas as $nueva)
                <div class="card">
                    <img src="/storage/{{$nueva->imagen}}" class="card-img-top"  alt="">
                    <div class="card-body">
                        <h3>{{ Str::title($nueva->titulo) }}</h3>
                        <p>{!! Str::words(strip_tags($nueva->preparacion), 15) !!}</p>
                        <a href="{{route('recetas.show',$nueva->id)}}" class="btn btn-primary b-block font-weight-bold text-uppercase" >Ver Receta</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4"> Recetas mas votadas</h2>
        <div class="row">
            @foreach ($votadas as $receta)
                @include('ui.receta')
            @endforeach
        </div>
    </div>

    @foreach ($recetas as $key => $grupo)
        @if (count($grupo[0]) > 0)
            <div class="container">
                <h2 class="titulo-categoria text-uppercase mt-5 mb-4"> {{ str_replace('-',' ', $key)}}</h2>
                <div class="row">
                    @foreach ($grupo as $recetas)
                        @foreach ($recetas as $receta)
                            @include('ui.receta')
                        @endforeach
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
@endsection