<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\TiposComprobantes\SeleccionarDebitos;
use App\Actions\TiposComprobantes\SeleccionarCreditos;

class TiposComprobantesController extends Controller
{

    public function getDebitos(Request $request, SeleccionarDebitos $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function getCreditos(Request $request, SeleccionarCreditos $action, $id = null)
    {
        return $action->run($request, $id);
    }
   
}