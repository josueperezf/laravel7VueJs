@extends('layouts/app')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css" integrity="sha512-pTg+WiPDTz84G07BAHMkDjq5jbLS/AqY0rU/QdugnfeE0+zu0Kjz++0rrtYNK9gtzEZ33p+S53S2skXAZttrug==" crossorigin="anonymous" />
@endsection
@section('botones')
    <a href="{{route('recetas.index')}}" class="btn btn-outline-primary mr-2 ">
        <svg class="iconoReceta" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
        Volver
    </a>
@endsection
@section('content')
    <h2 class="text-center">Crear Recetas</h2>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method="POST" action="{{ route('recetas.store') }}" novalidate  enctype="multipart/form-data"  >
                <!-- @csrf crea un meta que nos coloca un token para que no exista problemas al enviar el formulario-->
                @csrf
                <div class="form-group">
                    <label for="titulo"> Titulo Receta</label>
                    <input type="text"
                        name="titulo"
                        class="form-control  @error('titulo') is-invalid @enderror"
                        id="titulo"
                        value="{{old('titulo')}}"
                        placeholder="Titulo Receta">
                        @error('titulo')
                            <span class="invalid-feedback d-block" role='alert' >
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select name="categoria" id="categoria" class="form-control  @error('categoria') is-invalid @enderror" >
                        <option value="">SELECCIONE</option>
                        @foreach ($categorias as $id => $categoria )
                            <option
                                value="{{$id}}"
                                {{old('categoria') == $id ? 'selected' : ''}} >
                                    {{$categoria}}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria')
                        <span class="invalid-feedback d-block" role='alert' >
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <marquee behavior="" direction=""> trix-editor no funciona el editor de texto para negrita ni para nada</marquee>
                <div class="form-group mt-4">
                    <label for="preparacion"> Preparacion</label>
                    <input type="hidden" name="preparacion" id="preparacion" value="{{old('preparacion')}}" >
                    <trix-editor class="form-control @error('preparacion') is-invalid @enderror " input='preparacion' ></trix-editor>
                    @error('preparacion')
                        <span class="invalid-feedback d-block" role='alert' >
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="ingredientes"> Ingredientes</label>
                    <input type="hidden" name="ingredientes" id="ingredientes" value="{{old('ingredientes')}}" >
                    <trix-editor
                        input='ingredientes'
                        class="form-control @error('ingredientes') is-invalid @enderror "
                        ></trix-editor>
                    @error('ingredientes')
                        <span class="invalid-feedback d-block" role='alert' >
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="imagen">Elige Imagen</label>
                    <input
                        type="file"
                        name="imagen"
                        class="form-control @error('imagen') is-invalid @enderror "
                        id="imagen">
                    @error('imagen')
                        <span class="invalid-feedback d-block" role='alert' >
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                 </div>
                <div class="form-group">
                   <button type="submit" class="btn btn-primary">Agregar Receta</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js" integrity="sha512-EkeUJgnk4loe2w6/w2sDdVmrFAj+znkMvAZN6sje3ffEDkxTXDiPq99JpWASW+FyriFah5HqxrXKmMiZr/2iQA==" crossorigin="anonymous"></script> -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix-core.min.js" integrity="sha512-J6AhIdukc7Q1dwu9D8Vym7+MshmyshXOuMggFYBm9y2nWqxJkgeZqr7xZmrVDUu7fI5NjPV7n8d6W3l7zPSfhg==" crossorigin="anonymous"></script>
@endsection