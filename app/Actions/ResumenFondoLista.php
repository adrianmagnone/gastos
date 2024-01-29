<?php

namespace App\Actions;

use App\Lib\Actions\SelectAction;
use App\Models\MovimientoFondo;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class ResumenFondoLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'resumen_fondo.index';
        parent::__construct(MovimientoFondo::class);
    }

    protected function getQuery()
    {
        return $this->model
            ->where('saldo', '>', 0);
    }

    public function requestKey()
    {
        return 'ResumenFondo.Consulta';
    }

    protected function setFilterClass()
    {
        return \App\ActionFilters\MovimientoFondoFiltro::class;
    }

    protected function setFieldSustitute()
    {
        return [
            'id' => 'fecha'
        ];
    }

    protected function aditionalDataForList()
    {
        return [
            'listaFondos'    => \App\Models\Fondo::activos(),
        ];
    }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->id = $modelData->id;
        $record->futuro = (MiDate::greatToday($modelData->fecha)) ? 1 : 0; 
        if ($modelData->es_gasto)
            $record->fecha = ($record->futuro) ? MiDate::toMonthYearFormat($modelData->fecha) : MiDate::toFormat($modelData->fecha,'d/m/Y');
        else
            $record->fecha = MiDate::toFormat($modelData->fecha,'d/m/Y');
        $record->concepto = $modelData->nombre_concepto;
        $record->descripcion = $modelData->descripcion;
        $record->importe = Formatter::moneyArg($modelData->saldo);
        $record->tipo = $modelData->tipo;
        
        return $record;
    }
}