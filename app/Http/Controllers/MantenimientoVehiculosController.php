<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Actions\Vehiculos\MantenimientoVehiculoLista;
use App\Actions\Vehiculos\MantenimientoVehiculoEditar;
use App\Actions\Vehiculos\MantenimientoVehiculoExcel;
use App\Actions\Vehiculos\MantenimientoVehiculoTotales;

class MantenimientoVehiculosController extends Controller
{
    public function index(MantenimientoVehiculoLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, MantenimientoVehiculoLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function selectData(Request $request, MantenimientoVehiculoLista $action)
    {
        return $action->run($request);
    }

    public function toExcel(Request $request, MantenimientoVehiculoExcel $action)
    {
        return $action->runForExport($request);
    }

    public function create(MantenimientoVehiculoEditar $action)
    {
        return $action->runForCreate();
    }

    public function edit(MantenimientoVehiculoEditar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function store(Request $request, MantenimientoVehiculoEditar $action)
    {
        return $action->runForSave($request);
    }

    public function getTotalesAnuales(Request $request, MantenimientoVehiculoTotales $action)
    {
        return $action->run($request);
    }
}
