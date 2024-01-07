<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\MovimientoLista;
use App\Actions\MovimientoEditar;
use App\Actions\Movimientos\MensualIngreso;
use App\Actions\Movimientos\MensualEgreso;

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
}