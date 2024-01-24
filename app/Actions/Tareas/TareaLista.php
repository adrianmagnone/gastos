<?php

namespace App\Actions\Tareas;

use App\Lib\Actions\SelectAction;
use App\Models\Tarea;
 
class TareaLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'tareas.index';
        parent::__construct(Tarea::class);
    }

    public function requestKey()
    {
        return 'Tareas.Consulta';
    }

    protected function setFilterClass()
    {
        return \App\ActionFilters\TareaFiltro::class;
    }

    protected function aditionalDataForList()
    {
        return [
            'listaEstados' => Tarea::ESTADOS
        ];
    }

    protected function setSearchFields()
    {
        return ['descripcion', 'proyecto'];
    }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->id = $modelData->id;
        $record->estado = $modelData->estado;
        $record->fechaCreacion = $modelData->fecha_creacion_format;
        $record->proyecto = $modelData->proyecto;
        $record->descripcion = $modelData->descripcion;
        $record->fechaFin = $modelData->fecha_finalizacion_format;

        $record->esta_pendiente = $modelData->estado == 3 ? 1 : 0;

        return $record;
    }
}