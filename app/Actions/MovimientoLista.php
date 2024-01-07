<?php

namespace App\Actions;

use App\Lib\Actions\SelectAction;
use App\Models\Movimiento;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;
 
class MovimientoLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'movimientos.index';
        parent::__construct(Movimiento::class);
    }

    public function requestKey()
    {
        return 'Movimiento.Consulta';
    }

    protected function setFilterClass()
    {
        return \App\ActionFilters\MovimientoFiltro::class;
    }

    protected function setSearchFields()
    {
        return ['descripcion'];
    }

    protected function aditionalDataForList()
    {
        return [
            'listaTipos'      => Movimiento::TIPOS,
            'listaCategorias' => \App\Models\Categoria::all()
        ];
    }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->id          = $modelData->id;
        $record->fecha       = MiDate::toFormat($modelData->fecha,'d/m/Y');
        $record->categoria   = $modelData->descripcion_categoria;
        $record->descripcion = $modelData->descripcion;
        $record->importe     = Formatter::moneyArg($modelData->importe);
        $record->tipo        = $modelData->tipo;
        
        return $record;
    }
}