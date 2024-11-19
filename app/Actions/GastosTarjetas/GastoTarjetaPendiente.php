<?php

namespace App\Actions\GastosTarjetas;

use App\Lib\Actions\SelectAction;
use App\Models\CompraTarjeta;
 
class GastoTarjetaPendiente extends SelectAction
{
    function __construct()
    {
        parent::__construct(CompraTarjeta::class);
    }

    public function requestKey()
    {
        return 'GastosTarjetas.Pendientes';
    }

    protected function setFilterClass()
    {
        return \App\ActionFilters\GastoTarjetaFiltro::class;
    }

    protected function getQuery()
    {
        return $this->model
            ->where('cuotasPendientes', '>', 0);
    }

    protected function setFieldSustitute()
    {
        return [
            'item'      => 'id',
            'categoria' => 'categoria_id',
            'cuota'     => 'cuotasPendientes',
            'importe'   => 'importeCuota'
        ];
    }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->id          = $modelData->id;
        $record->fecha       = $modelData->fecha_format;
        $record->categoria   = $modelData->descripcion_categoria;
        $record->descripcion = $modelData->descripcion;
        $record->cuota       = ($modelData->cuotas + 1) - $modelData->cuotasPendientes . ' de ' . $modelData->cuotas;
        $record->pendientes  = $modelData->cuotasPendientes;
        $record->importe     = $modelData->importeCuota;
        $record->importe_real= $modelData->importe_cuota_edit;
        
        return $record;
    }
}