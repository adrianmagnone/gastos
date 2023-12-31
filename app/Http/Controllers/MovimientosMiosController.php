<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\MovimientoMioLista;
use App\Actions\MovimientoMioEditar;
use App\Actions\MovimientoMioImputar;

class MovimientosMiosController extends Controller
{
    public function index(MovimientoMioLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, MovimientoMioLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function create(MovimientoMioEditar $action)
    {
        return $action->runForCreate();
    }

    public function edit(MovimientoMioEditar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function store(Request $request, MovimientoMioEditar $action)
    {
        return $action->runForSave($request);
    }

    public function imput(MovimientoMioImputar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function storeImput(Request $request, MovimientoMioImputar $action)
    {
        return $action->runForSave($request);
    }
}