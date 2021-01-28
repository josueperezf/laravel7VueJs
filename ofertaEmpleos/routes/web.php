<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['verify'=> true]);

// rutas protegidas
Route::group(['middleware'=>['auth', 'verified']],function(){
    //vacantes
    Route::get('/vacantes/create','VacanteController@create')->name('vacantes.create');
    Route::get('/vacantes','VacanteController@index')->name('vacantes.index');
    Route::post('/vacantes','VacanteController@store')->name('vacantes.store');
    Route::get('/vacantes/{vacante}/edit','VacanteController@edit')->name('vacantes.edit');
    Route::put('/vacantes/{vacante}','VacanteController@update')->name('vacantes.update');
    //Subir imagenes

    Route::post('/vacantes/imagen','VacanteController@imagen')->name('vacantes.imagen');
    Route::post('/vacantes/borrarimagen','VacanteController@borrarimagen')->name('vacantes.borrarimagen');
    // Notificaciones
    // cambiar estado de la vacante
    Route::post('vacantes/{vacante}', 'VacanteController@cambiarEstado')->name('vacantes.cambiarEstado');

    // eliminar vacante
    Route::delete('vacantes/{vacante}', 'VacanteController@destroy')->name('vacantes.destroy');
    Route::get('/notificaciones', 'NotificacionesController')->name('notificaciones');
});

// pagina de inicio
Route::get('/', 'inicioController')->name('inicio.index');

// Categorias
Route::get('categorias/{categoria}', 'CategoriaController@show')->name('categorias.show');
// Enviar datps para una vacante
Route::get('/candidatos/{vacante_id}','CandidatoController@index')->name('candidatos.index');
Route::post('/candidatos/store','CandidatoController@store')->name('candidatos.store');

// rutas vacantes
//Buscar
Route::get('/vacantes/{vacante}','VacanteController@show')->name('vacantes.show');
Route::post('/buscarVacantes/buscar','VacanteController@buscar')->name('vacantes.buscar');
Route::get('buscarVacantes/resultados','VacanteController@resultados')->name('vacantes.resultados');
