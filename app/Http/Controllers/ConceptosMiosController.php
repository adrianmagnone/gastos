<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\Conceptos\ConceptoMioLista;
use App\Actions\Conceptos\ConceptoMioEditar;
use App\Actions\Conceptos\ConceptoMioExcel;

class ConceptosMiosController extends Controller
{
    public function index(ConceptoMioLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, ConceptoMioLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function selectData(Request $request, ConceptoMioLista $action)
    {
        return $action->run($request);
    }

    public function toExcel(Request $request, ConceptoMioExcel $action)
    {
        return $action->runForExport($request);
    }

    public function create(ConceptoMioEditar $action)
    {
        return $action->runForCreate();
    }

    public function edit(ConceptoMioEditar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function store(Request $request, ConceptoMioEditar $action)
    {
        return $action->runForSave($request);
    }
    
}