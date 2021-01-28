@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<link
      rel="stylesheet"
      href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/basic.css" integrity="sha512-Ucip2staDcls3OuwEeh5s9rRVYBsCA4HRr18+qd0Iz3nYpnfUeCIMh/82aHKeYgdaXGebmi9vcREw7YePXsutQ==" crossorigin="anonymous" />
@endsection
@section('content')
<!-- para hacer log logs https://github.com/rap2hpoutre/laravel-log-viewer-->
    <div class="container">
        <h1 class="text-center mt-4">Registrar Establecimiento</h1>
        <div class="mt-5 row justify-content-center ">
            <form action="{{route('establecimiento.store')}}" class="col-md-9 col-xs-12 card card-body" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="method" value="POST">
                <fieldset class="border p-4" >
                    <legend class="text-primary" >Nombre, Categoria e Imagen Principal</legend>
                    <div class="form-group">
                        <label for="nombre">Nombre Establecimiento</label>
                        <input
                            type="text" id="nombre"
                            name="nombre" placeholder="Nombre establecimiento"
                            class="form-control @error('nombre') is-invalid @enderror "
                            value="{{old('nombre')}}">
                        @error('nombre')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select name="categoria_id" id="categoria_id" class="form-control @error('categoria_id') is-invalid @enderror">
                            <option selected disabled>--SELECCIONE--</option>
                            @foreach ($categorias as $categoria)
                                <option
                                    value="{{$categoria->id}}"
                                    {{old('categoria_id')== $categoria->id ? 'selected' : ''}}
                                    >
                                    {{$categoria->nombre}}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="imagen_principal">Imagen Principal</label>
                        <input
                            type="file" id="imagen_principal"
                            name="imagen_principal" placeholder="Imagen principal"
                            class="form-control @error('imagen_principal') is-invalid @enderror"
                            value="{{old('imagen_principal')}}">
                        @error('imagen_principal')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </fieldset>
                <fieldset class="border p-4 mt-5" >
                    <legend class="text-primary" >Ubicacion</legend>
                    <div class="form-group">
                        <label for="formBuscador">Coloca la direccion del establecimiento</label>
                        <input
                            type="text" id="formBuscador"
                            placeholder="Calle del Negocio o establecimiento"
                            class="form-control"
                        >
                        <p class="text-secondary mt-5 mb-5 text-center">
                            El Asistente colocara una direccion estimada o mueve el pin hacia el lugar correcto
                        </p>
                    </div>
                    <div class="form-group">
                        <div id="mapa" style='height:400px;'></div>
                    </div>
                    <p class="informacion">Confirma que los siguientes campos son correctos</p>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input
                            type="text" id="direccion" name="direccion"
                            class="form-control @error('direccion') is-invalid @enderror"
                            value="{{old('direccion')}}">
                        @error('direccion')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="colonia">Colonia</label>
                        <input
                            type="text" id="colonia" name="colonia"
                            class="form-control @error('colonia') is-invalid @enderror"
                            value="{{old('colonia')}}">
                        @error('colonia')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <input type="hidden" name="latitud" id="latitud" value="{{old('latitud')}}">
                    <input type="hidden" name="longitud" id="longitud" value="{{old('longitud')}}">
                </fieldset>
                <fieldset class="border p-4 mt-5">
                    <legend  class="text-primary">Información Establecimiento: </legend>
                        <div class="form-group">
                            <label for="nombre">Teléfono</label>
                            <input
                                type="tel"
                                class="form-control @error('telefono')  is-invalid  @enderror"
                                id="telefono"
                                placeholder="Teléfono Establecimiento"
                                name="telefono"
                                value="{{ old('telefono') }}"
                            >

                                @error('telefono')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>



                        <div class="form-group">
                            <label for="nombre">Descripción</label>
                            <textarea
                                class="form-control  @error('descripcion')  is-invalid  @enderror"
                                name="descripcion"
                            >{{ old('descripcion') }}</textarea>

                                @error('descripcion')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="nombre">Hora Apertura:</label>
                            <input
                                type="time"
                                class="form-control @error('apertura')  is-invalid  @enderror"
                                id="apertura"
                                name="apertura"
                                value="{{ old('apertura') }}"
                            >
                            @error('apertura')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nombre">Hora Cierre:</label>
                            <input
                                type="time"
                                class="form-control @error('cierre')  is-invalid  @enderror"
                                id="cierre"
                                name="cierre"
                                value="{{ old('cierre') }}"
                            >
                            @error('cierre')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                </fieldset>
                <fieldset class="border p-4" >
                    <legend class="text-primary" >Imagenes</legend>
                    <div class="form-group">
                        <label for="imagenes">Imagenes</label>
                        <div id="dropzone" class="dropzone form-control"></div>
                    </div>
                </fieldset>
                <input type="hidden" name="uuid" id="uuid" value="{{Str::uuid()->toString()}}">
                <button type="submit" class="btn btn-primary mt-3 d-block"> Registrar Establecimiento</button>
            </form>
        </div>
    </div>
    @section('scripts')
    <!--defer es para que el script se cargue solo cuando el html ya este listo, antes no -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <script src="https://unpkg.com/esri-leaflet" defer></script>
    <script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js" integrity="sha512-9WciDs0XP20sojTJ9E7mChDXy6pcO0qHpwbEJID1YVavz2H6QBz5eLoDD8lseZOb2yGT8xDNIV7HIe1ZbuiDWg==" crossorigin="anonymous" defer></script>
    @endsection
@endsection
