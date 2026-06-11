<?php
 
namespace App\ActionFilters;

class MovimientoFiltro extends \Aiglos\Lba\Actions\FilterBase
{
    protected function setFiltersKeys()
    {
        return [ 'tipo', 'categoria', 'fecha' ];
    }

    protected function filtroTipo(&$query, $value)
    {
        $query->where('tipo', (int)$value);
    }

    protected function filtroCategoria(&$query, $value)
    {
        $query->where('categoria_id', (int)$value);
    }

    protected function filtroFecha(&$query, $value)
    {
        $this->filtroBetweenDate($query, $value['fechaDesde'], $value['fechaHasta'], 'fecha');
    }
}