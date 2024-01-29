<?php

namespace App\Actions;

use App\Lib\Actions\SelectAction;
use App\Models\MovimientoFondo;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;
 
class MovimientoFondoLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'movimientos_fondos.index';
        parent::__construct(MovimientoFondo::class);
    }

    public function requestKey()
    {
        return 'MovimientoFondo.Consulta';
    }

    protected function setFilterClass()
    {
        return \App\ActionFilters\MovimientoFondoFiltro::class;
    }

    protected function setSearchFields()
    {
        return ['descripcion'];
    }

    protected function aditionalDataForList()
    {
        return [
            'listaFondos'    => \App\Models\Fondo::all(),
            'listaTipos'     => MovimientoFondo::TIPOS,
            'listaConceptos' => \App\Models\ConceptoFondo::all()
        ];
    }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->id       = $modelData->id;
        $record->futuro   = (MiDate::greatToday($modelData->fecha)) ? 1 : 0; 
        $record->fecha    = MiDate::toFormat($modelData->fecha,'d/m/Y');
        $record->concepto = $modelData->nombre_concepto;
        $record->descripcion = $modelData->descripcion;
        $record->importe  = Formatter::moneyArg($modelData->importe);
        $record->saldo    = Formatter::moneyArg($modelData->saldo);
        $record->tipo     = $modelData->tipo;
        $record->pagado   = ($modelData->saldo == 0) ? 1 : 0;
        
        return $record;
    }
}