<?php
 
namespace App\ActionFilters;

class TareaFiltro extends \App\Lib\Actions\FilterBase
{
    protected function setFiltersKeys()
    {
        return [ 'estado' ];
    }

    protected function filtroEstado(&$query, $value)
    {
        $query->where('estado', (int)$value);
    }
}