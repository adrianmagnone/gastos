<?php

namespace App\Actions\Facturacion;

use App\Lib\Actions\SelectAction;
use App\Models\CuentaCorriente;

use App\Helpers\Formatter;
 
class CuentaCorrienteLista extends SelectAction
{
    protected $saldo;

    function __construct()
    {
        $this->saldo = 0;
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

    protected function setAditionalOrderFields()
    {
        return [
            ['field' => 'fecha',   'dir' => 'asc'],
            ['field' => 'id',      'dir' => 'asc']
        ];
    }

    protected function setFilterClass()
    {
        return \App\ActionFilters\CuentaCorrienteFiltro::class;
    }

    protected function aditionalDataForList()
    {
        return [
            'cuentas'  => \App\Models\Cuenta::activas(),
            'personas' => \App\Models\Persona::allByAbrev()
        ];
    }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->id          = $modelData->id;

        $record->fecha       = $modelData->fecha_format;
        $record->cuit        = $modelData->identificadorComprador;
        $record->cliente     = $modelData->nombre_persona;
        $record->comprobante = $modelData->comprobante;
        $record->saldo       = $modelData->saldo;
        $record->debe_f      = Formatter::moneyArg($modelData->debe);
        $record->haber_f     = Formatter::moneyArg($modelData->haber);
        $record->debe        = $modelData->debe;
        $record->haber       = $modelData->haber;

        $this->saldo = $this->saldo + ($modelData->debe - $modelData->haber);

        $record->saldo_deuda = Formatter::moneyArg($this->saldo);
        
        return $record;
    }
}