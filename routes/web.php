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
use App\Http\Controllers\ConceptosFondosController;
use App\Http\Controllers\MovimientosFondosController;
use App\Http\Controllers\ResumenFondoController;

use App\Http\Controllers\MantenimientoVehiculosController;
use App\Http\Controllers\VehiculosController;

use App\Http\Controllers\CuentasController;
use App\Http\Controllers\CuentasCorrientesController;
use App\Http\Controllers\MonotributoController;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\ResumenFacturacionController;

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
Route::get('categorias/ingresos/{id?}',         [CategoriasController::class, 'selectIngresos']);
Route::get('categorias/gastos/{id?}',           [CategoriasController::class, 'selectGastos']);
Route::post('categoria/guardar',                [CategoriasController::class, 'store'])->name('categoria.guardar');
Route::get('categoria/editar/{id}',             [CategoriasController::class, 'edit']);

// MOVIMIENTOS ----------------------------------------------------- 
Route::get('movimientos',                       [MovimientosController::class, 'index'])->name('movimientos');
Route::get('movimientos_data/{id?}',            [MovimientosController::class, 'getData']);
Route::get('movimientos/excel',                 [MovimientosController::class, 'toExcel']);
Route::get('movimiento/nuevo',                  [MovimientosController::class, 'create']);
Route::post('movimiento/guardar',               [MovimientosController::class, 'store'])->name('movimiento.guardar');
Route::get('movimiento/editar/{id}',            [MovimientosController::class, 'edit']);
Route::get('movimientos/importar_ingresos',     [MovimientosController::class, 'importIng']);
Route::post('movimientos/lee_ingresos',         [MovimientosController::class, 'readIng']);
Route::post('movimientos/guarda_ingresos',      [MovimientosController::class, 'storeIng']);


Route::get('movimientos_mensuales',             [MovimientosController::class, 'resumenMensual'])->name('movimientos_mensuales');
Route::get('movimientos_mes_ing_data',          [MovimientosController::class, 'resumenMensualIngresos']);
Route::get('movimientos_mes_egr_data',          [MovimientosController::class, 'resumenMensualEgresos']);

Route::get('movimientos_anuales',               [MovimientosController::class, 'resumenAnual'])->name('movimientos_anuales');
Route::get('movimientos_anual_ing_data',        [MovimientosController::class, 'resumenAnualIngresos']);
Route::get('movimientos_anual_egr_data',        [MovimientosController::class, 'resumenAnualEgresos']);

Route::get('actualizar_resumen_anual',          [MovimientosController::class, 'viewActualizarResumen'])->name('ver_actualizar_resumen');
Route::post('actualizar_resumen_anual',         [MovimientosController::class, 'actualizarResumen'])->name('actualizar_resumen');

// FONDOS  ----------------------------------------------------- 
Route::get('fondos',                            [FondosController::class, 'index'])->name('fondos');
Route::get('fondos_data/{id?}',                 [FondosController::class, 'getData']);
Route::get('fondos/excel',                      [FondosController::class, 'toExcel']);
Route::get('fondo/nuevo',                       [FondosController::class, 'create']);
Route::post('fondo/guardar',                    [FondosController::class, 'store'])->name('fondo.guardar');
Route::get('fondo/editar/{id}',                 [FondosController::class, 'edit']);

Route::get('conceptos_fondos',                  [ConceptosFondosController::class, 'index'])->name('conceptos_fondos');
Route::get('conceptos_fondos_data/{id?}',       [ConceptosFondosController::class, 'getData']);
Route::get('conceptos_fondos/excel',            [ConceptosFondosController::class, 'toExcel']);
Route::get('conceptos_fondos/nuevo',            [ConceptosFondosController::class, 'create']);
Route::post('conceptos_fondos/guardar',         [ConceptosFondosController::class, 'store'])->name('conceptos_fondos.guardar');
Route::get('conceptos_fondos/editar/{id}',      [ConceptosFondosController::class, 'edit']);

Route::get('movimientos_fondos',                [MovimientosFondosController::class, 'index'])->name('movimientos_fondos');
Route::get('movimientos_fondos_data/{id?}',     [MovimientosFondosController::class, 'getData']);
Route::get('movimientos_fondos/nuevo',          [MovimientosFondosController::class, 'create']);
Route::post('movimientos_fondos/guardar',       [MovimientosFondosController::class, 'store'])->name('movimientos_fondos.guardar');
Route::get('movimientos_fondos/editar/{id}',    [MovimientosFondosController::class, 'edit']);
Route::get('movimientos_fondos/imputar/{id}',   [MovimientosFondosController::class, 'imput']);
Route::post('movimientos_fondos/guardar_imputacion', [MovimientosFondosController::class, 'storeImput'])->name('movimientos_fondos.imputar');

Route::get('resumen_fondo',                     [ResumenFondoController::class, 'index'])->name('resumen_fondos');
Route::get('resumen_fondo_data',                [ResumenFondoController::class, 'getData']);
Route::get('resumen_fondo_mensuales',           [ResumenFondoController::class, 'getTotalesMensuales']);

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


// FACTURACION ----------------------------------------------------- 
Route::get('cuentas',                           [CuentasController::class, 'index'])->name('cuentas');
Route::get('cuentas_data/{id?}',                [CuentasController::class, 'getData']);
Route::get('cuenta/nueva',                      [CuentasController::class, 'create']);
Route::post('cuenta/guardar',                   [CuentasController::class, 'store'])->name('cuenta.guardar');
Route::get('cuenta/editar/{id}',                [CuentasController::class, 'edit']);

Route::get('personas',                               [PersonasController::class, 'index'])->name('personas');
Route::get('personas_data/{id?}',                    [PersonasController::class, 'getData']);
Route::get('persona/nueva',                          [PersonasController::class, 'create']);
Route::post('persona/guardar',                       [PersonasController::class, 'store'])->name('persona.guardar');
Route::get('persona/editar/{id}',                    [PersonasController::class, 'edit']);

Route::get('cuentas_corrientes',                     [CuentasCorrientesController::class, 'index'])->name('cuentas_corrientes');
Route::get('cuentas_corrientes_data/{id?}',          [CuentasCorrientesController::class, 'getData']);
Route::get('cuenta_corriente/importar_facturacion',  [CuentasCorrientesController::class, 'importFacturacion']);
Route::post('cuenta_corriente/archivo_facturacion',  [CuentasCorrientesController::class, 'readFacturacion']);
Route::post('cuenta_corriente/guardar_facturacion',  [CuentasCorrientesController::class, 'storeFacturacion']);
Route::get('cuenta_corriente/importar_pagos',        [CuentasCorrientesController::class, 'importPagos']);
Route::post('cuenta_corriente/archivo_pagos',        [CuentasCorrientesController::class, 'readPagos']);
Route::post('cuenta_corriente/guardar_pagos',        [CuentasCorrientesController::class, 'storePagos']);

Route::get('cuenta_corriente/imputar/{id}',          [CuentasCorrientesController::class, 'imput']);
Route::post('cuenta_corriente/imputacion',           [CuentasCorrientesController::class, 'storeImput'])->name('cuenta_corriente.imputar');
Route::get('cuenta_corriente/ver_imputacion/{id}',   [CuentasCorrientesController::class, 'viewImput']);
Route::get('cuenta_corriente/crear_gasto/{id}',      [CuentasCorrientesController::class, 'createGasto']);
Route::post('cuenta_corriente/guardar_gasto',        [CuentasCorrientesController::class, 'storeGasto'])->name('cuenta_corriente.guardar_gasto');

// RESUMEN DE FACTURACION - MONOTRIBUTO
Route::get('monotributo',                            [MonotributoController::class, 'index'])->name('monotributo');
Route::get('monotributo_data/{id?}',                 [MonotributoController::class, 'getData']);
Route::get('monotributo/nuevo',                      [MonotributoController::class, 'create']);
Route::post('monotributo/guardar',                   [MonotributoController::class, 'store'])->name('monotributo.guardar');
Route::get('monotributo/editar/{id}',                [MonotributoController::class, 'edit']);

Route::get('resumen_facturacion',                    [ResumenFacturacionController::class, 'index'])->name('resumen_facturacion');
Route::get('resumen_facturacion_data/{id?}',         [ResumenFacturacionController::class, 'getData']);

Route::get('actualizar_resumen_facturacion',         [ResumenFacturacionController::class, 'viewActualizarResumen']);
Route::post('actualizar_resumen_facturacion',        [ResumenFacturacionController::class, 'actualizarResumen'])->name('actualizar_resumen_facturacion');
