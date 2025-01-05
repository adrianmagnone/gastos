<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Actions\GastosTarjetas\GastoTarjetaLista;
use App\Actions\GastosTarjetas\GastoTarjetaEditar;
use App\Actions\GastosTarjetas\GastoTarjetaExcel;
use App\Actions\GastosTarjetas\ResumenTarjetaLista;
use App\Actions\GastosTarjetas\GastoTarjetaPendiente;

class GastosTarjetasController extends Controller
{
    public function index(GastoTarjetaLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, GastoTarjetaLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function selectData(Request $request, GastoTarjetaLista $action)
    {
        return $action->run($request);
    }

    public function toExcel(Request $request, GastoTarjetaExcel $action)
    {
        return $action->runForExport($request);
    }

    public function getPendientes(Request $request, GastoTarjetaPendiente $action, $id = null)
    {
        return $action->run($request, $id);
    }
    
    public function create(GastoTarjetaEditar $action)
    {
        return $action->runForCreate();
    }

    public function edit(GastoTarjetaEditar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function store(Request $request, GastoTarjetaEditar $action)
    {
        return $action->runForSave($request);
    }

    public function delete(GastoTarjetaEditar $action, $id = null)
    {
        return $action->runForDelete($id);
    }

    public function saveDelete(Request $request, GastoTarjetaEditar $action)
    {
        return $action->runForSaveDelete($request);
    }

    public function resumen(ResumenTarjetaLista $action)
    {
        return $action->viewList();
    }

    public function resumenData(Request $request, ResumenTarjetaLista $action, $id = null)
    {
        return $action->run($request, $id);
    }
}
