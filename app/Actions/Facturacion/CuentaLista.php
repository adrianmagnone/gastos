<?php

namespace App\Actions\Facturacion;

use App\Lib\Actions\SelectAction;
use App\Models\Cuenta;
 
class CuentaLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'cuentas.index';
        parent::__construct(Cuenta::class);
    }

    public function requestKey()
    {
        return 'Cuentas.Consulta';
    }

    protected function setSearchFields()
    {
        return ['nombre'];
    }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->id     = $modelData->id;
        $record->nombre = $modelData->nombre;
        $record->estado = $modelData->estado;
        
        return $record;
    }
}