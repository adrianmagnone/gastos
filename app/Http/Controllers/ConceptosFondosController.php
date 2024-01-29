<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\Fondos\ConceptoFondoLista;
use App\Actions\Fondos\ConceptoFondoEditar;
use App\Actions\Fondos\ConceptoFondoExcel;

class ConceptosFondosController extends Controller
{
    public function index(ConceptoFondoLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, ConceptoFondoLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function selectData(Request $request, ConceptoFondoLista $action)
    {
        return $action->run($request);
    }

    public function toExcel(Request $request, ConceptoFondoExcel $action)
    {
        return $action->runForExport($request);
    }

    public function create(ConceptoFondoEditar $action)
    {
        return $action->runForCreate();
    }

    public function edit(ConceptoFondoEditar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function store(Request $request, ConceptoFondoEditar $action)
    {
        return $action->runForSave($request);
    }
    
}