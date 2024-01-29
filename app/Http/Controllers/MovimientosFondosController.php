<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\MovimientoFondoLista;
use App\Actions\MovimientoFondoEditar;
use App\Actions\MovimientoFondoImputar;

class MovimientosFondosController extends Controller
{
    public function index(MovimientoFondoLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, MovimientoFondoLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function create(MovimientoFondoEditar $action)
    {
        return $action->runForCreate();
    }

    public function edit(MovimientoFondoEditar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function store(Request $request, MovimientoFondoEditar $action)
    {
        return $action->runForSave($request);
    }

    public function imput(MovimientoFondoImputar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function storeImput(Request $request, MovimientoFondoImputar $action)
    {
        return $action->runForSave($request);
    }
}