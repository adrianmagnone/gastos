<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Helpers\DateHelper as MiDate;

use App\Actions\Facturacion\ResumenFacturacionLista;

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

    public function viewActualizarResumen()
    {
        $fecha = MiDate::object();
        return view('resumen_facturacion.fecha')->with([ 
            'saveUrl' => route('actualizar_resumen_facturacion'),
            'cuentas' => \App\Models\Cuenta::activas(),
            'fecha'   => $fecha->format('d/m/Y')
        ]);
    }

    public function actualizarResumen(Request $request)
    {
        \App\Models\ResumenFacturacion::actualizarResumen($request->fecha, (int)$request->cuenta_id);

        return redirect()->route('resumen_facturacion');
    }
}