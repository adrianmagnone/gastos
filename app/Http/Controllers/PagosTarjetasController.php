<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Actions\PagosTarjetas\PagoTarjetaLista;
use App\Actions\PagosTarjetas\PagoTarjetaEditar;
use App\Actions\PagosTarjetas\PagoPasarGastos;

class PagosTarjetasController extends Controller
{
    public function index(PagoTarjetaLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, PagoTarjetaLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function create(PagoTarjetaEditar $action)
    {
        return $action->runForCreate();
    }

    public function edit(PagoTarjetaEditar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function store(Request $request, PagoTarjetaEditar $action)
    {
        return $action->runForSave($request);
    }

    public function view($id = null)
    {
        $pago = \App\Models\PagoTarjeta::findOrFail($id);

        return view('pagos_tarjetas.view', ['entity' => $pago]);
    }

    public function passToGasto(Request $request, PagoPasarGastos $action, $id = null)
    {
        return $action->run($request, $id);
    }
}
