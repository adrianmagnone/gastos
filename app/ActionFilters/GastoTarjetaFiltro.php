<?php
 
namespace App\ActionFilters;

class GastoTarjetaFiltro extends \App\Lib\Actions\FilterBase
{
    protected function setFiltersKeys()
    {
        return [ 'tarjeta', 'estado' ];
    }


    protected function filtroTarjeta(&$query, $value)
    {
        $query->where('tarjeta_id', (int)$value);
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