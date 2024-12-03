<?php

namespace App\Actions\Personas;

use App\Lib\Actions\SelectAction;
use App\Models\Persona;
 
class PersonaLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'personas.index';
        parent::__construct(Persona::class);
    }

    public function requestKey()
    {
        return 'Persona.Consulta';
    }

    // protected function setFilterClass()
    // {
    //     return \App\ActionFilters\MantenimientoVehiculoFiltro::class;
    // }

    protected function setSearchFields()
    {
        return ['nombre'];
    }

    // protected function aditionalDataForList()
    // {
    //     return [
    //         'listaVehiculos'  => \App\Models\Vehiculo::all(),
    //     ];
    // }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->id = $modelData->id;
        $record->nombre        = $modelData->nombre;
        $record->abreviatura   = $modelData->abreviatura;
        $record->tipoDocumento = $modelData->descripcion_tipo_documento;
        $record->identificador = $modelData->identificador;
        
        return $record;
    }
}