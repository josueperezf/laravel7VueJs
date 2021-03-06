@extends('layouts/app')
@section('botones')
    @include('ui/navegacion')
@endsection
@section('content')
    <h2 class="text-center">Administra tus Recetas</h2>
   <div class="col-md-10 mx-auto bg-white p-3">
       fuente de los iconos https://heroicons.dev/ <br> se busca el icono, se preciona en el para copiar el svg y se pega y ya
       <table class="table">
           <thead class="bg-primary text-light">
               <tr>
                   <th scole="col"> Titlo </th>
                   <th scole="col"> Categoria </th>
                   <th scole="col"> Acciones </th>
               </tr>
           </thead>
           <tbody>
               @foreach ($recetas as $receta)
               <tr>
                    <td>{{$receta->titulo}}</td>
                    <td>{{$receta->categoria->nombre}}</td>
                   <td>
                        <eliminar-receta receta-id="{{$receta->id}}" ></eliminar-receta>
                        <!--<form method="POST" action="{{route('recetas.destroy',$receta->id)}}">
                            @method('DELETE')
                            @csrf
                           <button type="submit" class="btn btn-danger w-100 d-block mb-2">Eliminar</button>
                       </form>-->
                        <a href="{{ route('recetas.edit',$receta->id) }}" class="btn btn-dark d-block mb-2">Editar</a>
                        <a href="{{ route('recetas.show',$receta->id) }}" class="btn btn-success d-block mb-2"  >Ver</a>
                   </td>
               </tr>
               @endforeach
           </tbody>
       </table>
       <!--
            d-flex es una clase de bootstrap que le coloca el display en flex,
            si quisieramos un display none, la clase seria d-none.

            mt-4 es para margen top 4
        -->
       <div class="col-12 mt-4 justify-content-center d-flex">
           {{ $recetas->links() }}
       </div>
       <h2 class="text-center my-5">Recetas que te gustan</h2>
       <div class="col-md-10 mx-auto bg-white p-3">
           @if ($usuario->meGusta->count()>0) 
            <ul class="list-group">
                @foreach ($usuario->meGusta as $receta)
                <li class="list-group-item d-flex justify-content-between align-items-center " >
                    <p> {{$receta->titulo}} </p>
                    <a href="{{route('recetas.show',$receta->id)}}" class="btn btn-outline-success text-uppercase font-weight-bold " > Ver </a>
                    </li>
                    @endforeach
                </ul>
            @else 
                <p class="text-center">Aun no tienes recetas Guardadas <small>Dale me gusta a las recetas y apareceran aqui</small> </p>
            @endif
       </div>
   </div>
@endsection