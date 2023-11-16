<?php

namespace App\Actions;

use App\Lib\Actions\SelectAction;
use App\Models\MovimientoMio;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class ResumenMioLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'resumen_mio.index';
        parent::__construct(MovimientoMio::class);
    }

    protected function getQuery()
    {
        return $this->model
            ->where('saldo', '>', 0);
    }

    public function requestKey()
    {
        return 'ResumenMio.Consulta';
    }

    protected function setFieldSustitute()
    {
        return [
            'id' => 'fecha'
        ];
    }

    // protected function setSearchFields()
    // {
    //     return ['descripcion'];
    // }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->id = $modelData->id;
        $record->futuro = (MiDate::greatToday($modelData->fecha)) ? 1 : 0; 
        if ($modelData->es_gasto)
            $record->fecha = ($record->futuro) ? MiDate::toFormat($modelData->fecha,'M Y') : MiDate::toFormat($modelData->fecha,'d/m/Y');
        else
            $record->fecha = MiDate::toFormat($modelData->fecha,'d/m/Y');
        $record->concepto = $modelData->nombre_concepto;
        $record->descripcion = $modelData->descripcion;
        $record->importe = Formatter::moneyArg($modelData->saldo);
        $record->tipo = $modelData->tipo;
        $record->futuro = (MiDate::greatToday($modelData->fecha)) ? 1 : 0; 
        
        return $record;
    }
}