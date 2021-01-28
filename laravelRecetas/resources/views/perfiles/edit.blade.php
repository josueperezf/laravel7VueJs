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
    <h1 class="text-center">
        Editar mi perfil
    </h1>
    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
            <form method="POST" action="{{ route('perfiles.update',$perfil->id) }}" novalidate  enctype="multipart/form-data"  >
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre"> Nombre</label>
                    <input type="text"
                        name="nombre"
                        class="form-control  @error('nombre') is-invalid @enderror"
                        id="nombre"
                        value="{{$perfil->usuario->name}}"
                        placeholder="Tu Nombre">
                        @error('nombre')
                            <span class="invalid-feedback d-block" role='alert' >
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="url"> Sitio web</label>
                    <input type="text"
                        name="url"
                        class="form-control  @error('url') is-invalid @enderror"
                        id="url"
                        value="{{$perfil->usuario->url}}"
                        placeholder="la url de tu sitio">
                        @error('url')
                            <span class="invalid-feedback d-block" role='alert' >
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="biografia"> Biografia</label>
                    <input type="hidden" name="biografia" id="biografia" value="{{$perfil->biografia}}" >
                    <trix-editor class="form-control @error('biografia') is-invalid @enderror " input='biografia' ></trix-editor>
                    @error('biografia')
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
                    @if ($perfil->imagen)        
                        <div class="mt-4">
                            <p>Imagen Actual:</p>
                            <img src="/storage/{{$perfil->imagen}}" alt="" width="300px"> 
                        </div>
                    @endif
                    @error('imagen')
                        <span class="invalid-feedback d-block" role='alert' >
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                 </div>
                 <div class="form-group">
                    <button type="submit" class="btn btn-primary">Editar Perfil</button>
                 </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js" integrity="sha512-EkeUJgnk4loe2w6/w2sDdVmrFAj+znkMvAZN6sje3ffEDkxTXDiPq99JpWASW+FyriFah5HqxrXKmMiZr/2iQA==" crossorigin="anonymous"></script> -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix-core.min.js" integrity="sha512-J6AhIdukc7Q1dwu9D8Vym7+MshmyshXOuMggFYBm9y2nWqxJkgeZqr7xZmrVDUu7fI5NjPV7n8d6W3l7zPSfhg==" crossorigin="anonymous"></script>
@endsection