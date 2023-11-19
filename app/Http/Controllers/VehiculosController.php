<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\Vehiculos\VehiculoLista;
use App\Actions\Vehiculos\VehiculoEditar;
use App\Actions\Vehiculos\VehiculoExcel;

class VehiculosController extends Controller
{
    public function index(VehiculoLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, VehiculoLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function selectData(Request $request, VehiculoLista $action)
    {
        return $action->run($request);
    }

    public function toExcel(Request $request, VehiculoExcel $action)
    {
        return $action->runForExport($request);
    }

    public function create(VehiculoEditar $action)
    {
        return $action->runForCreate();
    }

    public function edit(VehiculoEditar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function store(Request $request, VehiculoEditar $action)
    {
        return $action->runForSave($request);
    }
}