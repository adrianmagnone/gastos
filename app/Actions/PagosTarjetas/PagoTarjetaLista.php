<?php

namespace App\Actions\PagosTarjetas;

use App\Lib\Actions\SelectAction;
use App\Models\PagoTarjeta;
 
class PagoTarjetaLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'pagos_tarjetas.index';
        parent::__construct(PagoTarjeta::class);
    }

    public function requestKey()
    {
        return 'PagosTarjetas.Consulta';
    }

    protected function setFilterClass()
    {
        return \App\ActionFilters\PagoTarjetaFiltro::class;
    }

    protected function setFieldSustitute()
    {
        return [
            'periodo' => 'periodoPago'
        ];
    }

    protected function aditionalDataForList()
    {
        return [
            'listaTarjetas' => \App\Models\Tarjeta::all()
        ];
    }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->id            = $modelData->id;
        $record->fecha_pago    = $modelData->fecha_pago_format;
        $record->periodo       = ($record->fecha_pago)
                                        ? $modelData->periodo_format
                                        : 'Liquidación ' . $modelData->periodo_format;
        $record->total_pagado  = $modelData->total_pagado_format;
        $record->total_cuotas  = $modelData->total_cuotas_format;
        $record->total_seguros = $modelData->total_seguros_format;
        $record->gastos        = $modelData->total_gastos_format;        
        

        $record->n_total_pagado  = $modelData->totalPagado;
        $record->n_total_cuotas  = $modelData->totalCuotas;
        $record->n_total_seguros = $modelData->totalSeguros;
        $record->n_total_gastos  = $modelData->total_gastos;        

        return $record;
    }
}