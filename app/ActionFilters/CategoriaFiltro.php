<?php
 
namespace App\ActionFilters;

use App\Helpers\DateHelper as MiDate;

class CategoriaFiltro extends \App\Lib\Actions\FilterBase
{
    protected function setFiltersKeys()
    {
        return [ 'uso', 'estado'  ];
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