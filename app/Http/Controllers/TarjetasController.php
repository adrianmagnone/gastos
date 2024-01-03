<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\Tarjetas\TarjetaLista;
use App\Actions\Tarjetas\TarjetaEditar;
use App\Actions\Tarjetas\TarjetaExcel;

class TarjetasController extends Controller
{
    public function index(TarjetaLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, TarjetaLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function selectData(Request $request, TarjetaLista $action)
    {
        return $action->run($request);
    }

    public function toExcel(Request $request, TarjetaExcel $action)
    {
        return $action->runForExport($request);
    }

    public function create(TarjetaEditar $action)
    {
        return $action->runForCreate();
    }

    public function edit(TarjetaEditar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function store(Request $request, TarjetaEditar $action)
    {
        return $action->runForSave($request);
    }
    
}