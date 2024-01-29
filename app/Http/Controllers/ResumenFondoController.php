<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\ResumenFondoLista;
use App\Actions\ResumenFondoTotales;

class ResumenFondoController extends Controller
{
    public function index(ResumenFondoLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, ResumenFondoLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function getTotalesMensuales(Request $request, ResumenFondoTotales $action, $id = null)
    {
        return $action->run($request, $id);
    }
}