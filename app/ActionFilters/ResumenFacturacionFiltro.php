<?php
 
namespace App\ActionFilters;

use App\Helpers\DateHelper as MiDate;

class ResumenFacturacionFiltro extends \App\Lib\Actions\FilterBase
{
    protected function setFiltersKeys()
    {
        return [ 'cuenta', 'fecha' ];
    }

    protected function filtroCuenta(&$query, $value)
    {
        $query->where('cuenta_id', $value);
    }

    protected function filtroFecha(&$query, $value)
    {
        $this->filtroBetweenDate($query, $value['fechaDesde'], $value['fechaHasta'], 'periodo');
    }
}