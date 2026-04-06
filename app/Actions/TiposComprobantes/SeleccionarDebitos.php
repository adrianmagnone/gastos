<?php

namespace App\Actions\TiposComprobantes;

use App\Lib\Actions\SelectAction;
use App\Models\TipoComprobante  ;
 
class SeleccionarDebitos extends SelectAction
{
    function __construct()
    {
        parent::__construct(TipoComprobante::class);
    }

    public function requestKey()
    {
        return 'TipoComprobante.Consulta';
    }

    protected function setSearchFields()
    {
        return ['descripcion'];
    }

    protected function setSelectionFilter(&$query)
    {
        $query->where('tipo', (int)TipoComprobante::Tipos('Debe'));
    }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->id = $modelData->id;
        $record->descripcion = $modelData->descripcion;
        $record->tipo = $modelData->tipo;
        $record->codigoAfip = $modelData->codigoAfip;
        
        return $record;
    }
}