<h2 class="my-10 text-2xl text-gray-700">Buscar una Vacante</h2>

<form action="{{route('vacantes.buscar')}}" method="POST">
    @csrf
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
                    {{old('categoria') == $categoria->id ? 'selected': ''}}
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
                    {{old('ubicacion') == $ubicacion->id ? 'selected': ''}}
                    value="{{$ubicacion->id}}">{{$ubicacion->nombre}}</option>
            @endforeach
        </select>
        @error('ubicacion')
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 w-full mt-5 text-sm" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <button class="bg-teal-500 w-full hover:bg-teal-600 text-gray-100 font-bold p-3 focus:shadow-outline uppercase mt-10">
        Buscar Vacantes
    </button>
</form>
