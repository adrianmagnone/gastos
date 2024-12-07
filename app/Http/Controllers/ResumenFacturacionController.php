<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\Facturacion\ResumenFacturacionLista;
//use App\Actions\ResumenFacturacionTotales;

class ResumenFacturacionController extends Controller
{
    public function index(ResumenFacturacionLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, ResumenFacturacionLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    // public function getTotalesMensuales(Request $request, ResumenFacturacionTotales $action, $id = null)
    // {
    //     return $action->run($request, $id);
    // }
}