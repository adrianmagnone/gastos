<?php
 
namespace App\ActionFilters;

class MovimientoFondoFiltro extends \App\Lib\Actions\FilterBase
{
    protected function setFiltersKeys()
    {
        return [ 'tipo', 'concepto', 'saldo', 'fondo'];
    }

    protected function filtroTipo(&$query, $value)
    {
        $query->where('tipo', (int)$value);
    }

    protected function filtroConcepto(&$query, $value)
    {
        $query->where('concepto_id', (int)$value);
    }

    protected function filtroFondo(&$query, $value)
    {
        $query->where('fondo_id', (int)$value);
    }

    protected function filtroSaldo(&$query, $value)
    {
        if ($value == 'S')
        {
            $query->where('saldo', '>' ,0);
        }
        if ($value == 'N')
        {
            $query->where('saldo', 0);
        }
    }

}