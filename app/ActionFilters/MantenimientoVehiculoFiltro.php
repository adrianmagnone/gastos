<?php
 
namespace App\ActionFilters;

class MantenimientoVehiculoFiltro extends \Aiglos\Lba\Actions\FilterBase
{
    protected function setFiltersKeys()
    {
        return [ 'vehiculo', 'fecha' ];
    }

    protected function filtroVehiculo(&$query, $value)
    {
        $query->where('vehiculo_id', (int)$value);
    }

    protected function filtroFecha(&$query, $value)
    {
        $this->filtroBetweenDate($query, $value['fechaDesde'], $value['fechaHasta'], 'fecha');
    }
}