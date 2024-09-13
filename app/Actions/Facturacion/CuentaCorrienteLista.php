<?php

namespace App\Actions\Facturacion;

use App\Lib\Actions\SelectAction;
use App\Models\CuentaCorriente;

use App\Helpers\Formatter;
 
class CuentaCorrienteLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'cuentas_corrientes.index';
        parent::__construct(CuentaCorriente::class);
    }

    public function requestKey()
    {
        return 'CuentasCorrientes.Consulta';
    }

    protected function setSearchFields()
    {
        return [];
    }

    protected function setFilterClass()
    {
        return \App\ActionFilters\CuentaCorrienteFiltro::class;
    }

    protected function aditionalDataForList()
    {
        return [
            'cuentas'  => \App\Models\Cuenta::activas(),
            'personas' => \App\Models\Persona::all()
        ];
    }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->id         = $modelData->id;

        $record->fecha      = $modelData->fecha_format;
        $record->cuit       = $modelData->identificadorComprador;
        $record->cliente    = $modelData->nombre_persona;
        $record->comprobante= $modelData->comprobante;
        $record->debe       = Formatter::moneyArg($modelData->debe);
        $record->haber      = Formatter::moneyArg($modelData->haber);
        
        return $record;
    }
}