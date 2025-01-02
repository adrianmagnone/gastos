<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\Facturacion\MonotributoLista;
use App\Actions\Facturacion\MonotributoEditar;

class MonotributoController extends Controller
{
    public function index(MonotributoLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, MonotributoLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function create(MonotributoEditar $action)
    {
        return $action->runForCreate();
    }

    public function edit(MonotributoEditar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function store(Request $request, MonotributoEditar $action)
    {
        return $action->runForSave($request);
    }
}