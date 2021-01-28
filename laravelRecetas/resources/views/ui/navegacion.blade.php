<a href="{{route('recetas.create')}}" class="btn btn-outline-primary mr-2">
    <svg class="iconoReceta" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    Crear Receta
</a>
<a href="{{route('perfiles.show',auth()->user()->id)}}" class="btn btn-outline-success mr-2">
    <svg class="iconoReceta"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
    Ver mi perfil
</a>
<a href="{{route('perfiles.edit',auth()->user()->id)}}" class="btn btn-outline-info mr-2"> 
    <svg class="iconoReceta" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
    Editar perfil
</a>