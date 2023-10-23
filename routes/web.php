<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ConceptosMiosController;
use App\Http\Controllers\MovimientosMiosController;
use App\Http\Controllers\ResumenMioController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('welcome');
})->name('login');

 
Route::get('resumen_mio',                       [ResumenMioController::class, 'index'])->name('resumen_mio');
Route::get('resumen_mio_data',                  [ResumenMioController::class, 'getData']);
Route::get('resumen_mio_mensuales',             [ResumenMioController::class, 'getTotalesMensuales']);

Route::get('movimientos_mios/nuevo',            [MovimientosMiosController::class, 'create']);
Route::post('movimientos_mios/guardar',         [MovimientosMiosController::class, 'store'])->name('movimientos_mios.guardar');
Route::get('movimientos_mios/editar/{id}',      [MovimientosMiosController::class, 'edit']);
Route::get('movimientos_mios/imputar/{id}',     [MovimientosMiosController::class, 'imput']);
Route::post('movimientos_mios/guardar_imputacion', [MovimientosMiosController::class, 'storeImput'])->name('movimientos_mios.imputar');

Route::get('conceptos_mios',                    [ConceptosMiosController::class, 'index'])->name('conceptos_mios');
Route::get('conceptos_mios_data/{id?}',         [ConceptosMiosController::class, 'getData']);
Route::get('conceptos_mios/excel',              [ConceptosMiosController::class, 'toExcel']);
Route::get('conceptos_mios/nuevo',              [ConceptosMiosController::class, 'create']);
Route::post('conceptos_mios/guardar',           [ConceptosMiosController::class, 'store'])->name('conceptos_mios.guardar');
Route::get('conceptos_mios/editar/{id}',        [ConceptosMiosController::class, 'edit']);