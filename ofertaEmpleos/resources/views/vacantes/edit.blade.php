@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/css/medium-editor.min.css" integrity="sha512-zYqhQjtcNMt8/h4RJallhYRev/et7+k/HDyry20li5fWSJYSExP9O07Ung28MUuXDneIFg0f2/U3HJZWsTNAiw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/basic.css" integrity="sha512-Ucip2staDcls3OuwEeh5s9rRVYBsCA4HRr18+qd0Iz3nYpnfUeCIMh/82aHKeYgdaXGebmi9vcREw7YePXsutQ==" crossorigin="anonymous" />
@endsection
@section('navegacion')
    @include('ui.administrarv')
@endsection
@section('content')
    <h1 class="text-2xl text-center mt-10">Editar Vacantes</h1>
    <form action="{{route('vacantes.update',['vacante'=>$vacante->id])}}" method="post" class=" max-w-lg mx-auto my-10" novalidate >
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="mb-5">
            <label for="" class="block text-gray-700 text-sm mb-2">Titulo vacante</label>
            <input
                id="titulo" type="text" class="p-3 bg-gray-100 rounded form-input w-full @error('titulo') border-red-500 border @enderror" name="titulo" value="{{ $vacante->titulo }}" required autocomplete="titulo" autofocus='autofocus'
                placeholder="Titulo de la vacantes">
            @error('titulo')
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-full mt-5 text-sm" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="categoria" class="block text-gray-700 text-sm mb-2">Categoria</label>
            <select name="categoria" id="categoria" class="
                    @error('categoria') border-red-500 border @enderror
                    block appearance-none w-full
                    border border-gray-200
                    text-gray-700 rounded
                    leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100">
                    <option selected disabled>SELECCIONA</option>
                @foreach ($categorias as $categoria)
                    <option
                        {{$vacante->categoria_id == $categoria->id ? 'selected': ''}}
                        value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                @endforeach
            </select>
            @error('categoria')
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-full mt-5 text-sm" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="experiencia" class="block text-gray-700 text-sm mb-2">Experiencia</label>
            <select name="experiencia" id="experiencia" class="
                    @error('experiencia') border-red-500 border @enderror
                    block appearance-none w-full
                    border border-gray-200
                    text-gray-700 rounded
                    leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100">
                    <option selected disabled>SELECCIONA</option>
                @foreach ($experiencias as $experiencia)
                    <option
                        {{ $vacante->experiencia_id == $experiencia->id ? 'selected': ''}}
                        value="{{$experiencia->id}}">{{$experiencia->nombre}}</option>
                @endforeach
            </select>
            @error('experiencia')
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-full mt-5 text-sm" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="ubicacion" class="block text-gray-700 text-sm mb-2">Ubicacion</label>
            <select name="ubicacion" id="ubicacion" class="
                    @error('ubicacion') border-red-500 border @enderror
                    block appearance-none w-full
                    border border-gray-200
                    text-gray-700 rounded
                    leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100">
                    <option selected disabled>SELECCIONA</option>
                @foreach ($ubicacions as $ubicacion)
                    <option
                        {{ $vacante->ubicacion_id == $ubicacion->id ? 'selected': ''}}
                        value="{{$ubicacion->id}}">{{$ubicacion->nombre}}</option>
                @endforeach
            </select>
            @error('ubicacion')
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-full mt-5 text-sm" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="salario" class="block text-gray-700 text-sm mb-2">Salarios</label>
            <select name="salario" id="salario" class="
                    @error('salario') border-red-500 border @enderror
                    block appearance-none w-full
                    border border-gray-200
                    text-gray-700 rounded
                    leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-gray-100">
                    <option selected disabled>SELECCIONA</option>
                @foreach ($salarios as $salario)
                    <option
                        {{ $vacante->salario_id == $salario->id ? 'selected': ''}}
                        value="{{$salario->id}}">{{$salario->monto}}</option>
                @endforeach
            </select>
            @error('salario')
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-full mt-5 text-sm" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="descripcion" class="block text-gray-700 text-sm mb-2">Descripcion</label>
                <div class="editable p-3 bg-gray-100 rounded form-input w-full text-gray-700
                            @error('descripcion') border-red-500 border @enderror
                            ">
                </div>
                <input type="hidden" name="descripcion" id="descripcion" value="{{ $vacante->descripcion }}">
                @error('descripcion')
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-full mt-5 text-sm" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
        </div>
        <div class="mb-5">
            <label for="imagen" class="block text-gray-700 text-sm mb-2">Imagen del puesto</label>
            <div id="dropzoneDevJobs" class=" @error('imagen') border-red-500 border @enderror dropzone p-10 rounded bg-gray-100  "></div>
            <p id="error"></p>
            <input type="hidden" name="imagen" id="imagen" value="{{ $vacante->imagen }}">
            @error('imagen')
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-full mt-5 text-sm" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="habilidades" class="block text-gray-700 text-sm mb-2 ">Habilidades y conocimientos <span class="text-xs " >(Elige al menos 3)</span> </label>
            @php
                $habilidades = ['HTML5', 'CSS3', 'CSSGrid', 'Flexbox', 'JavaScript', 'jQuery', 'Node', 'Angular', 'VueJS', 'ReactJS', 'React Hooks', 'Redux', 'Apollo', 'GraphQL', 'TypeScript', 'PHP', 'Laravel', 'Symfony', 'Python', 'Django', 'ORM', 'Sequelize', 'Mongoose', 'SQL', 'MVC', 'SASS', 'WordPress', 'Express', 'Deno', 'React Native', 'Flutter', 'MobX', 'C#', 'Ruby on Rails'];
            @endphp
            <input type="hidden" name="habilidades" id="inputHabilidades">
            <lista-habilidades
                    :habilidades="{{ json_encode($habilidades)}}"
                    :old_habilidades="{{ json_encode($vacante->habilidades )}}"
                >
            </lista-habilidades>
            @error('habilidades')
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-full mt-5 text-sm" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>

        <button type="submit" class="bg-teal-500 w-full hover:bg-teal-700 text-gray-100 p-3 focus:online-none focus:shadow-outline uppercase font-bold">
            Publicar vacante
        </button>
    </form>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/js/medium-editor.min.js" integrity="sha512-5D/0tAVbq1D3ZAzbxOnvpLt7Jl/n8m/YGASscHTNYsBvTcJnrYNiDIJm6We0RPJCpFJWowOPNz9ZJx7Ei+yFiA==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js" integrity="sha512-9WciDs0XP20sojTJ9E7mChDXy6pcO0qHpwbEJID1YVavz2H6QBz5eLoDD8lseZOb2yGT8xDNIV7HIe1ZbuiDWg==" crossorigin="anonymous"></script>
    <script>
        var x;
        Dropzone.autoDiscover = false;
        document.addEventListener('DOMContentLoaded',()=>{
            // medium
            var editor = new MediumEditor('.editable', {
                        toolbar: {
                            buttons: [
                                    'bold', 'italic', 'underline', 'anchor', 'h2', 'h3', 'quote',
                                    'justifyLeft','justifyCenter', 'justifyRight','justifyFull',
                                    'orderedList'],
                            static: true,
                            /* options which only apply when static is true */
                            sticky: false,
                        },
                        placeholder:{
                            text:'Informacion de la vacante'
                        }
                    });
            // agregar al usuario lo que el usuario escribe
            editor.subscribe('editableInput', function(evento, editable){
                const contenido = editor.getContent();
                document.querySelector('#descripcion').value=contenido;
            });
            // le asigna al editable un valor por default, para no perder la informacion cuando el usuario da enviar
            editor.setContent(document.querySelector('#descripcion').value);



            // dropzone
            const dropzoneDevJobs = new Dropzone('#dropzoneDevJobs',{
                url: '/vacantes/imagen',
                dictDefaultMessage:'Sube tu archivo',
                acceptedFiles:".png,.jpg,.jpeg,.gif,.bmp",
                addRemoveLinks:true,
                dictRemoveFile:'Remover Archivo',
                maxFiles:1,
                headers:{
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                init:function(){
                    if(document.querySelector('#imagen').value.trim()){
                        console.log('hay que cargar');
                        let imagenPublicada = {};
                        imagenPublicada.size = 123;
                        imagenPublicada.name = document.querySelector('#imagen').value.trim();
                        this.options.addedfile.call(this, imagenPublicada);
                        this.options.thumbnail.call(this, imagenPublicada, `/storage/vacantes/${imagenPublicada.name}`);
                        imagenPublicada.previewElement.classList.add('dz-sucess');
                        imagenPublicada.previewElement.classList.add('dz-complete');
                    }
                },
                success: function(file, respuesta){
                    //console.log(respuesta);
                    document.querySelector('#error').textContent="";
                    if(respuesta && respuesta.correcto){
                        document.querySelector('#imagen').value=respuesta.correcto;
                        // añadir el nombre nuevo del archivo dado por el servidor
                        file.nombreServidor= respuesta.correcto;
                    }
                    // file.previewElement.parentNode.removeChild(file.previewElement);

                },
                /*
                error: function(file, errorMessage){
                    console.log(errorMessage);
                    if(errorMessage== "You can't upload files of this type.") {
                        document.querySelector('#error').textContent="Formato no Valido";
                    }
                    // file.previewElement.parentNode.removeChild(file.previewElement);

                },*/
                maxfilesexceeded:function(file){
                    if(this.files.length > 1 ){
                        console.log('debe eliminar');

                        // file.previewElement.parentNode.removeChild(file.previewElement);
                        //file.previewElement.parentNode.removeChild( this.files[0].previewElement);
                        //this.files[0].previewElement.parentNode.removeChild(this.files[0].previewElement);
                        this.removeFile(this.files[0]);

                        // this.removeFile(file);
                        this.addFile(file);
                    }
                },
                removedfile:function(file, respuesta){
                    file.previewElement.parentNode.removeChild(file.previewElement);
                    console.log('archivo borrado fue: ', file);
                    if(file){
                        params = {
                            imagen: file.nombreServidor ?? document.querySelector('#imagen').value
                        }
                        axios.post('/vacantes/borrarimagen',params)
                            .then((respuesta)=>{ console.log(respuesta)});
                    }
                }
            });
        });
    </script>
@endsection
