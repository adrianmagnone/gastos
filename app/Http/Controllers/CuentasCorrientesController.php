<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\Facturacion\CuentaCorrienteLista;
use App\Actions\Facturacion\CuentaCorrienteImportarFacturacion;
use App\Actions\Facturacion\CuentaCorrienteImportarPagos;
use App\Actions\Facturacion\CuentaCorrienteImputar;

class CuentasCorrientesController extends Controller
{
    public function index(CuentaCorrienteLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, CuentaCorrienteLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function importFacturacion(CuentaCorrienteImportarFacturacion $action)
    {
        return $action->runImport();
    }

    public function readFacturacion(Request $request, CuentaCorrienteImportarFacturacion $action)
    {
        return $action->runLoadFile($request);
    }

    public function storeFacturacion(Request $request, CuentaCorrienteImportarFacturacion $action)
    {
        return $action->runSaveOneByOne($request);
    }

    public function importPagos(CuentaCorrienteImportarPagos $action)
    {
        return $action->runImport();
    }

    public function readPagos(Request $request, CuentaCorrienteImportarPagos $action)
    {
        return $action->runLoadFile($request);
    }

    public function storePagos(Request $request, CuentaCorrienteImportarPagos $action)
    {
        return $action->runSaveOneByOne($request);
    }


    public function imput(CuentaCorrienteImputar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function storeImput(Request $request, CuentaCorrienteImputar $action)
    {
        return $action->runForSave($request);
    }

    public function viewImput($id = null)
    {
        $movimiento = \App\Models\CuentaCorriente::findOrFail($id);

        $imputaciones = ($movimiento->columna == 'D')
                            ? \App\Models\Imputacion::deDebe($movimiento->id)
                            : \App\Models\Imputacion::deHaber($movimiento->id);


        return view('cuentas_corrientes.viewimput')->with([
            'entity'       => $movimiento,
            'imputaciones' => $imputaciones,
            'field'        => ($movimiento->columna == 'D') ? 'comprobanteHaber' : 'comprobanteDebe'
        ]);
    }
}