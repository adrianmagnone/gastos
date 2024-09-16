<?php
 
namespace App\ActionFilters;

use App\Helpers\DateHelper as MiDate;

class CuentaCorrienteFiltro extends \App\Lib\Actions\FilterBase
{
    protected function setFiltersKeys()
    {
        return [ 'cuenta', 'persona', 'saldo' ];
    }

    protected function filtroCuenta(&$query, $value)
    {
        $query->where('cuenta_id', $value);
    }

    protected function filtroPersona(&$query, $value)
    {
        $query->where('persona_id', $value);
    }

    protected function filtroSaldo(&$query, $value)
    {
        if ($value == 'S')
        {
            $query->where('saldo', '>', 0);
        }
        if ($value == 'N')
        {
            $query->where('saldo', 0);
        }
    }

    protected function filtroUso(&$query, $value)
    {
        if ((int)$value == 1)
            $query->whereRaw('(uso = 1 OR uso = 3)');

        if ((int)$value == 2)
            $query->whereRaw('(uso = 2 OR uso = 3)');
    }

    protected function filtroEstado(&$query, $value)
    {
        if ($value == 'S')
        {
            $query->where('estado', 1);
        }
        if ($value == 'N')
        {
            $query->where('estado', 0);
        }
    }

}