<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\Categorias\CategoriaLista;
use App\Actions\Categorias\CategoriaEditar;
use App\Actions\Categorias\CategoriaExcel;

class CategoriasController extends Controller
{
    public function index(CategoriaLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, CategoriaLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function selectData(Request $request, CategoriaLista $action)
    {
        return $action->run($request);
    }

    public function selectIngresos(Request $request, CategoriaLista $action)
    {
        // $request->request->add(['uso' => 1, 'estado' => 'S']);
        return $action->run($request);
    }

    public function selectGastos(Request $request, CategoriaLista $action)
    {
        $request->request->add(['uso' => 2, 'estado' => 'S']);
        return $action->run($request);
    }

    public function toExcel(Request $request, CategoriaExcel $action)
    {
        return $action->runForExport($request);
    }

    public function create(CategoriaEditar $action)
    {
        return $action->runForCreate();
    }

    public function edit(CategoriaEditar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function store(Request $request, CategoriaEditar $action)
    {
        return $action->runForSave($request);
    }
    
}