<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Helpers\DateHelper as MiDate;

use App\Models\Movimiento;

use App\Actions\MovimientoLista;
use App\Actions\MovimientoEditar;
use App\Actions\Movimientos\MensualIngreso;
use App\Actions\Movimientos\MensualEgreso;
use App\Actions\Movimientos\AnualIngreso;
use App\Actions\Movimientos\AnualEgreso;
use App\Actions\Movimientos\ImportarIngreso;

class MovimientosController extends Controller
{
    public function index(MovimientoLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, MovimientoLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function create(MovimientoEditar $action)
    {
        return $action->runForCreate();
    }

    public function edit(MovimientoEditar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function store(Request $request, MovimientoEditar $action)
    {
        return $action->runForSave($request);
    }

    // Resumen Mensual

    public function resumenMensual()
    {
        return view('movimientos.resumen_mensual');
    }

    public function resumenMensualIngresos(Request $request, MensualIngreso $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function resumenMensualEgresos(Request $request, MensualEgreso $action, $id = null)
    {
        return $action->run($request, $id);
    }

    // Resumen Anual

    public function resumenAnual()
    {
        return view('movimientos.resumen_anual')->with(['anio' => MiDate::today('Y')]);
    }

    public function resumenAnualIngresos(Request $request, AnualIngreso $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function resumenAnualEgresos(Request $request, AnualEgreso $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function viewActualizarResumen()
    {
        $fecha = MiDate::object();
        return view('movimientos.year')->with([ 
            'saveUrl' => route('actualizar_resumen'),
            'year' => $fecha->year
        ]);
    }

    public function actualizarResumen(Request $request)
    {
        Movimiento::actualizarResumen((int)$request->year);

        return redirect()->route('movimientos_anuales');
    }

    public function importIng(ImportarIngreso $action)
    {
        return $action->runImport();
    }

    public function readIng(Request $request, ImportarIngreso $action)
    {
        return $action->runLoadFile($request);
    }

    public function storeIng(Request $request, ImportarIngreso $action)
    {
        return $action->runForSave($request);
    }
}