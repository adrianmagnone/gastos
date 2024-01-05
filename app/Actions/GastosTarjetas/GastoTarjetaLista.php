<?php

namespace App\Actions\GastosTarjetas;

use App\Lib\Actions\SelectAction;
use App\Models\CompraTarjeta;
 
class GastoTarjetaLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'gastos_tarjetas.index';
        parent::__construct(CompraTarjeta::class);
    }

    public function requestKey()
    {
        return 'GastosTarjetas.Consulta';
    }

    protected function setFilterClass()
    {
        return \App\ActionFilters\GastoTarjetaFiltro::class;
    }

    protected function setFieldSustitute()
    {
        return [
            'pendientes' => 'cuotasPendientes',
            'categoria'  => 'categoria_id'
        ];
    }

    protected function setSearchFields()
    {
        return ['descripcion'];
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

        $record->id          = $modelData->id;
        $record->fecha       = $modelData->fecha_format;
        $record->descripcion = $modelData->descripcion;
        $record->categoria   = $modelData->descripcion_categoria;
        $record->total       = $modelData->total_format;
        $record->importe_cuota = $modelData->importe_cuota_format;
        $record->cuotas      = $modelData->cuotas;
        $record->pendientes  = $modelData->cuotasPendientes;
        
        return $record;
    }
}