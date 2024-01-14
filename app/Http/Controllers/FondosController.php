<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\Fondos\FondoLista;
use App\Actions\Fondos\FondoEditar;
use App\Actions\Fondos\FondoExcel;

class FondosController extends Controller
{
    public function index(FondoLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, FondoLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function selectData(Request $request, FondoLista $action)
    {
        return $action->run($request);
    }

    public function toExcel(Request $request, FondoExcel $action)
    {
        return $action->runForExport($request);
    }

    public function create(FondoEditar $action)
    {
        return $action->runForCreate();
    }

    public function edit(FondoEditar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function store(Request $request, FondoEditar $action)
    {
        return $action->runForSave($request);
    }
    
}