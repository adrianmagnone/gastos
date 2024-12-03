<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Actions\Personas\PersonaLista;
use App\Actions\Personas\PersonaEditar;
use App\Actions\Personas\PersonaExcel;

class PersonasController extends Controller
{
    public function index(PersonaLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, PersonaLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function selectData(Request $request, PersonaLista $action)
     {
        return $action->run($request);
    }

    public function toExcel(Request $request, PersonaExcel $action)
    {
        return $action->runForExport($request);
    }

    public function create(PersonaEditar $action)
    {
        return $action->runForCreate();
    }

    public function edit(PersonaEditar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function store(Request $request, PersonaEditar $action)
    {
        return $action->runForSave($request);
    }
}