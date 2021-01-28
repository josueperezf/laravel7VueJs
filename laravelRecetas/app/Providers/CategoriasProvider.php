<?php

namespace App\Providers;

use App\CategoriaReceta;
use Illuminate\Support\ServiceProvider;
use View;
class CategoriasProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // registra todo antes de que laravel comience
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // se ejecuta todo cuando la aplicacion esta lista, es la mas usada
        // con la siguiente linea de codigo le enviamos a las vistas una variable llamada categoria
        View::composer('*', function($view){
            $categorias = CategoriaReceta::all();
            $view->with('categorias',$categorias);

        });
    }
}
