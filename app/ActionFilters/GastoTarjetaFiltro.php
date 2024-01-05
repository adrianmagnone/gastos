<?php
 
namespace App\ActionFilters;

use App\Helpers\DateHelper as MiDate;
class GastoTarjetaFiltro extends \App\Lib\Actions\FilterBase
{
    protected function setFiltersKeys()
    {
        return [ 'tarjeta', 'estado', 'periodo' ];
    }


    protected function filtroTarjeta(&$query, $value)
    {
        $query->where('tarjeta_id', (int)$value);
    }

    protected function filtroPeriodo(&$query, $value)
    {
        $query->where('periodoInicial', '<=',  MiDate::fromFormatTo('d/m/Y', $value, 'Y-m-d'));
    }

    protected function filtroEstado(&$query, $value)
    {
        if ($value == 'S')
        {
            $query->where('cuotasPendientes', '>' ,0);
        }
        if ($value == 'N')
        {
            $query->where('cuotasPendientes', 0);
        }
    }

}