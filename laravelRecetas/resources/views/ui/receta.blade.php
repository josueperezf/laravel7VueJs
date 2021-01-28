<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img src="/storage/{{$receta->imagen}}" alt="" class="card-img-top">
        <div class="card-body">
            <h3 class="card-title"> {{$receta->titulo}}</h3>
            <div class="meta-receta d-flex justify-content-between">
                <p class="text-primary fecha font-weight-bold">
                    <fecha-receta fecha="{{$receta->created_at}}" ></fecha-receta>
                </p>
                <p>
                    {{count($receta->likes)}} les gusto
                </p>
            </div>
            <p>
                {{Str::words(strip_tags($receta->preparacion), 20, 'algo mas...') }}
            </p>
            <a class="btn btn-primary d-block btn-receta" href="{{route('recetas.show',['receta'=>$receta->id])}}">Ver</a>
        </div>
    </div>
</div>