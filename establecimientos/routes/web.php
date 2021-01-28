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
use App\Http\Controllers\InicioController;

Route::get('/',  InicioController::class)->name('inicio');

Auth::routes(['verify'=> true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/establecimiento', [App\Http\Controllers\EstablecimientoController::class, 'index'])->name('establecimiento.index');
    // ->middleware('revisar'); es para que una persona solo pueda registrar un solo establecimiento, teniendo en cuenta que a futuro si se podria crear cuentas pagas donde se les permita a los usuarios poder registrar cantidad ilimitada de establecimientos
    Route::get('/establecimiento/create', [App\Http\Controllers\EstablecimientoController::class, 'create'])->name('establecimiento.create')->middleware('revisar');
    Route::post('/establecimiento/store', [App\Http\Controllers\EstablecimientoController::class, 'store'])->name('establecimiento.store');
    Route::get('/establecimiento/edit', [App\Http\Controllers\EstablecimientoController::class, 'edit'])->name('establecimiento.edit');
    Route::put('/establecimiento/{establecimiento}', [App\Http\Controllers\EstablecimientoController::class, 'update'])->name('establecimiento.update');

    Route::post('/imagenes/store', [App\Http\Controllers\ImagenController::class, 'store'])->name('imagenes.store');
    Route::post('/imagenes/destroy', [App\Http\Controllers\ImagenController::class, 'destroy'])->name('imagenes.destroy');
});
// plugin para logs
// https://github.com/rap2hpoutre/laravel-log-viewer
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
