<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\TarjetasController;
use App\Http\Controllers\MovimientosController;
use App\Http\Controllers\TareasController;

use App\Http\Controllers\GastosTarjetasController;
use App\Http\Controllers\PagosTarjetasController;

use App\Http\Controllers\FondosController;

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

Route::get('/login', function () {
    return view('welcome');
})->name('login');


Route::get('/',                                 [IndexController::class, 'index']);

// CATEGORIAS----------------------------------------------------- 
Route::get('categorias',                        [CategoriasController::class, 'index'])->name('categorias');
Route::get('categorias_data/{id?}',             [CategoriasController::class, 'getData']);
Route::get('categorias/excel',                  [CategoriasController::class, 'toExcel']);
Route::get('categoria/nueva',                   [CategoriasController::class, 'create']);
Route::get('categorias/ingresos',               [CategoriasController::class, 'selectIngresos']);
Route::get('categorias/gastos',                 [CategoriasController::class, 'selectGastos']);
Route::post('categoria/guardar',                [CategoriasController::class, 'store'])->name('categoria.guardar');
Route::get('categoria/editar/{id}',             [CategoriasController::class, 'edit']);

// MOVIMIENTOS ----------------------------------------------------- 
Route::get('movimientos',                       [MovimientosController::class, 'index'])->name('movimientos');
Route::get('movimientos_data/{id?}',            [MovimientosController::class, 'getData']);
Route::get('movimientos/excel',                 [MovimientosController::class, 'toExcel']);
Route::get('movimiento/nuevo',                  [MovimientosController::class, 'create']);
Route::post('movimiento/guardar',               [MovimientosController::class, 'store'])->name('movimiento.guardar');
Route::get('movimiento/editar/{id}',            [MovimientosController::class, 'edit']);

Route::get('movimientos_mensuales',             [MovimientosController::class, 'resumenMensual'])->name('movimientos_mensuales');
Route::get('movimientos_mes_ing_data',          [MovimientosController::class, 'resumenMensualIngresos']);
Route::get('movimientos_mes_egr_data',          [MovimientosController::class, 'resumenMensualEgresos']);

Route::get('movimientos_anuales',               [MovimientosController::class, 'resumenAnual'])->name('movimientos_anuales');
Route::get('movimientos_anual_ing_data',        [MovimientosController::class, 'resumenAnualIngresos']);
Route::get('movimientos_anual_egr_data',        [MovimientosController::class, 'resumenAnualEgresos']);

// FONDOS  ----------------------------------------------------- 
Route::get('fondos',                            [FondosController::class, 'index'])->name('fondos');
Route::get('fondos_data/{id?}',                 [FondosController::class, 'getData']);
Route::get('fondos/excel',                      [FondosController::class, 'toExcel']);
Route::get('fondo/nuevo',                       [FondosController::class, 'create']);
Route::post('fondo/guardar',                    [FondosController::class, 'store'])->name('fondo.guardar');
Route::get('fondo/editar/{id}',                 [FondosController::class, 'edit']);

// TARJETAS  ----------------------------------------------------- 
Route::get('tarjetas',                          [TarjetasController::class, 'index'])->name('tarjetas');
Route::get('tarjetas_data/{id?}',               [TarjetasController::class, 'getData']);
Route::get('tarjetas/excel',                    [TarjetasController::class, 'toExcel']);
Route::get('tarjeta/nueva',                     [TarjetasController::class, 'create']);
Route::post('tarjeta/guardar',                  [TarjetasController::class, 'store'])->name('tarjeta.guardar');
Route::get('tarjeta/editar/{id}',               [TarjetasController::class, 'edit']);

// GASTOS TARJETAS ------------------------------------------------- 
Route::get('gastos_tarjetas',                   [GastosTarjetasController::class, 'index'])->name('gastos_tarjetas');
Route::get('gastos_tarjetas_data/{id?}',        [GastosTarjetasController::class, 'getData']);
Route::get('gastos_tarjetas/excel',             [GastosTarjetasController::class, 'toExcel']);
Route::get('gasto_tarjeta/nueva',               [GastosTarjetasController::class, 'create']);
Route::post('gasto_tarjeta/guardar',            [GastosTarjetasController::class, 'store'])->name('gasto_tarjeta.guardar');
Route::get('gasto_tarjeta/editar/{id}',         [GastosTarjetasController::class, 'edit']);
Route::get('resumen_tarjetas',                  [GastosTarjetasController::class, 'resumen'])->name('resumen_tarjetas');
Route::get('resumen_tarjetas_data/{id?}',       [GastosTarjetasController::class, 'resumenData']);

Route::get('gastos_tarjetas_a_pagar',           [GastosTarjetasController::class, 'getPendientes']);


// PAGOS TARJETAS  ------------------------------------------------- 
Route::get('pagos_tarjetas',                    [PagosTarjetasController::class, 'index'])->name('pagos_tarjetas');
Route::get('pagos_tarjetas_data/{id?}',         [PagosTarjetasController::class, 'getData']);
Route::get('pago_tarjeta/nuevo',                [PagosTarjetasController::class, 'create']);
Route::post('pago_tarjeta/guardar',             [PagosTarjetasController::class, 'store'])->name('pago_tarjeta.guardar');
Route::get('pago_tarjeta/editar/{id}',          [PagosTarjetasController::class, 'edit']);
Route::get('pago_tarjeta/consultar/{id}',       [PagosTarjetasController::class, 'view']);
Route::get('pago_tarjeta/pasar/{id}',           [PagosTarjetasController::class, 'passToGasto']);

// TAREAS  ------------------------------------------------- 
Route::get('tareas',                            [TareasController::class, 'index'])->name('tareas');
Route::get('tareas_data/{id?}',                 [TareasController::class, 'getData']);
Route::get('tarea/nueva',                       [TareasController::class, 'create']);
Route::post('tarea/guardar',                    [TareasController::class, 'store'])->name('tarea.guardar');
Route::get('tarea/editar/{id}',                 [TareasController::class, 'edit']);

Route::get('tarea/fin/{id}',                    [TareasController::class, 'finish']);
Route::get('tarea/cancelar/{id}',               [TareasController::class, 'cancel']);


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