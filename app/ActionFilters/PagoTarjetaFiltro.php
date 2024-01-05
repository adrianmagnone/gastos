<?php
 
namespace App\ActionFilters;

use App\Helpers\DateHelper as MiDate;

class PagoTarjetaFiltro extends \App\Lib\Actions\FilterBase
{
    protected function setFiltersKeys()
    {
        return [ 'tarjeta', 'periodo' ];
    }


    protected function filtroTarjeta(&$query, $value)
    {
        $query->where('tarjeta_id', (int)$value);
    }

    protected function filtroPeriodo(&$query, $value)
    {
        $query->whereYear('periodoPago', $value);
    }
}