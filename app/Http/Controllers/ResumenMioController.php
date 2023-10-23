<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\ResumenMioLista;
use App\Actions\ResumenMioTotales;

class ResumenMioController extends Controller
{
    public function index(ResumenMioLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, ResumenMioLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function getTotalesMensuales(Request $request, ResumenMioTotales $action, $id = null)
    {
        return $action->run($request, $id);
    }
}