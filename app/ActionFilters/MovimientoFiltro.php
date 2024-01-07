<?php
 
namespace App\ActionFilters;

class MovimientoFiltro extends \App\Lib\Actions\FilterBase
{
    protected function setFiltersKeys()
    {
        return [ 'tipo', 'categoria' ];
    }

    protected function filtroTipo(&$query, $value)
    {
        $query->where('tipo', (int)$value);
    }

    protected function filtroCategoria(&$query, $value)
    {
        $query->where('categoria_id', (int)$value);
    }

}