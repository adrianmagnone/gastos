<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\TarjetasController;

use App\Http\Controllers\ConceptosMiosController;
use App\Http\Controllers\MovimientosMiosController;
use App\Http\Controllers\ResumenMioController;

use App\Http\Controllers\MantenimientoVehiculosController;
use App\Http\Controllers\VehiculosController;

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
    $data = [];

    $fila1 = new stdClass();
    $fila1->name = '';
    $fila1->data = [155, 65, 465, 265, 225, 325, 80];

    $fila2 = new stdClass();
    $fila2->name = '';
    $fila2->data = [113, 42, 65, 54, 76, 65, 35];

    $data[] = $fila1;
    $data[] = $fila2;

    return view('welcome', ['serieGastos' => json_encode($data)]);
});

Route::get('/login', function () {
    return view('welcome');
})->name('login');

// CATEGORIAS----------------------------------------------------- 
Route::get('categorias',                        [CategoriasController::class, 'index'])->name('categorias');
Route::get('categorias_data/{id?}',             [CategoriasController::class, 'getData']);
Route::get('categorias/excel',                  [CategoriasController::class, 'toExcel']);
Route::get('categoria/nueva',                   [CategoriasController::class, 'create']);
Route::post('categoria/guardar',                [CategoriasController::class, 'store'])->name('categoria.guardar');
Route::get('categoria/editar/{id}',             [CategoriasController::class, 'edit']);

// TARJETAS  ----------------------------------------------------- 
Route::get('tarjetas',                          [TarjetasController::class, 'index'])->name('tarjetas');
Route::get('tarjetas_data/{id?}',               [TarjetasController::class, 'getData']);
Route::get('tarjetas/excel',                    [TarjetasController::class, 'toExcel']);
Route::get('tarjeta/nueva',                     [TarjetasController::class, 'create']);
Route::post('tarjeta/guardar',                  [TarjetasController::class, 'store'])->name('tarjeta.guardar');
Route::get('tarjeta/editar/{id}',               [TarjetasController::class, 'edit']);

// GASTOS MIOS ----------------------------------------------------- 
Route::get('resumen_mio',                       [ResumenMioController::class, 'index'])->name('resumen_mio');
Route::get('resumen_mio_data',                  [ResumenMioController::class, 'getData']);
Route::get('resumen_mio_mensuales',             [ResumenMioController::class, 'getTotalesMensuales']);

Route::get('movimientos_mios',                  [MovimientosMiosController::class, 'index'])->name('movimientos_mios');
Route::get('movimientos_mios_data/{id?}',       [MovimientosMiosController::class, 'getData']);
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

// VEHICULOS ----------------------------------------------------- 
Route::get('mantenimiento_vehiculos',           [MantenimientoVehiculosController::class, 'index'])->name('mantenimiento_vehiculos');
Route::get('mantenimiento_vehiculos_data/{id?}',[MantenimientoVehiculosController::class, 'getData']);
Route::get('mantenimiento_vehiculos/excel',     [MantenimientoVehiculosController::class, 'toExcel']);
Route::get('mantenimiento_vehiculo/nuevo',      [MantenimientoVehiculosController::class, 'create']);
Route::post('mantenimiento_vehiculo/guardar',   [MantenimientoVehiculosController::class, 'store'])->name('mantenimiento_vehiculo.guardar');
Route::get('mantenimiento_vehiculo/editar/{id}',[MantenimientoVehiculosController::class, 'edit']);
Route::get('mantenimiento_vehiculos_anual',     [MantenimientoVehiculosController::class, 'getTotalesAnuales']);

Route::get('vehiculos',                         [VehiculosController::class, 'index'])->name('vehiculos');
Route::get('vehiculos_data/{id?}',              [VehiculosController::class, 'getData']);
Route::get('vehiculos/excel',                   [VehiculosController::class, 'toExcel']);
Route::get('vehiculo/nuevo',                    [VehiculosController::class, 'create']);
Route::post('vehiculo/guardar',                 [VehiculosController::class, 'store'])->name('vehiculo.guardar');
Route::get('vehiculo/editar/{id}',              [VehiculosController::class, 'edit']);