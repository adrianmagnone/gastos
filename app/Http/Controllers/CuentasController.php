<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\Facturacion\CuentaLista;
use App\Actions\Facturacion\CuentaEditar;

class CuentasController extends Controller
{
    public function index(CuentaLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, CuentaLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function create(CuentaEditar $action)
    {
        return $action->runForCreate();
    }

    public function edit(CuentaEditar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function store(Request $request, CuentaEditar $action)
    {
        return $action->runForSave($request);
    }
}