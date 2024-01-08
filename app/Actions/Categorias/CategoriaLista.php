<?php

namespace App\Actions\Categorias;

use App\Lib\Actions\SelectAction;
use App\Models\Categoria;
 
class CategoriaLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'categorias.index';
        parent::__construct(Categoria::class);
    }

    public function requestKey()
    {
        return 'Categorias.Consulta';
    }

    protected function setFilterClass()
    {
        return \App\ActionFilters\CategoriaFiltro::class;
    }

    protected function aditionalDataForList()
    {
        return [
            'listaUsos' => Categoria::USOS
        ];
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
        $record->uso = $modelData->uso;
        $record->desc_uso = Categoria::USOS[$modelData->uso];
        
        return $record;
    }
}