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
            'pendientes' => 'cuotasPendientes'
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
        $record->periodo       = $modelData->periodo_format;
        $record->fecha_pago    = $modelData->fecha_pago_format;
        $record->total_pagado  = $modelData->total_pagado_format;
        $record->total_cuotas  = $modelData->total_cuotas_format;
        $record->total_seguros = $modelData->total_seguros_format;
        
        
        return $record;
    }
}