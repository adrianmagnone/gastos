<?php

namespace App\Actions\Vehiculos;

use App\Lib\Actions\SelectAction;
use App\Models\MantenimientoVehiculo;
 
class MantenimientoVehiculoLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'mantenimiento_vehiculos.index';
        parent::__construct(MantenimientoVehiculo::class);
    }

    public function requestKey()
    {
        return 'MantenimientoVehiculos.Consulta';
    }

    protected function setFilterClass()
    {
        return \App\ActionFilters\MantenimientoVehiculoFiltro::class;
    }

    protected function setSearchFields()
    {
        return ['descripcion'];
    }

    protected function aditionalDataForList()
    {
        return [
            'listaVehiculos'  => \App\Models\Vehiculo::all(),
        ];
    }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->id = $modelData->id;
        $record->fecha = $modelData->fecha_format;
        $record->vehiculo = $modelData->descripcion_vehiculo;
        $record->descripcion = $modelData->descripcion;
        $record->importe = $modelData->importe_format;
        $record->km = $modelData->km_format;
        
        return $record;
    }
}