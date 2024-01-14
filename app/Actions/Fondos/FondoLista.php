<?php

namespace App\Actions\Fondos;

use App\Lib\Actions\SelectAction;
use App\Models\Fondo;
 
class FondoLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'fondos.index';
        parent::__construct(Fondo::class);
    }

    public function requestKey()
    {
        return 'Fondos.Consulta';
    }

    protected function setSearchFields()
    {
        return ['nombre'];
    }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->id = $modelData->id;
        $record->nombre = $modelData->nombre;
        $record->estado = $modelData->estado;
        
        return $record;
    }
}