<?php

namespace App\Actions\Facturacion;

use App\Lib\Actions\SelectAction;
use App\Models\CategoriaMonotributo;
 
class MonotributoLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'categorias_monotributo.index';
        parent::__construct(CategoriaMonotributo::class);
    }

    public function requestKey()
    {
        return 'Monotributo.Consulta';
    }

    protected function setFieldSustitute()
    {
        return [
            'fecha' => ['fecha_vigencia', 'categoria'],
        ];
    }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->id        = $modelData->id;
        $record->fecha     = $modelData->fecha_format;
        $record->categoria = $modelData->categoria;
        $record->importe   = $modelData->importe_format;
        $record->mensual   = $modelData->importe_mensual_format;
        $record->caracter  = \ord($modelData->categoria) - 64;
        
        return $record;
    }
}