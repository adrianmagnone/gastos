<?php
 
namespace App\ActionFilters;

class TareaFiltro extends \Aiglos\Lba\Actions\FilterBase
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