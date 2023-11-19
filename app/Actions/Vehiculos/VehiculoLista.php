<?php

namespace App\Actions\Vehiculos;

use App\Lib\Actions\SelectAction;
use App\Models\Vehiculo;
 
class VehiculoLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'vehiculos.index';
        parent::__construct(Vehiculo::class);
    }

    public function requestKey()
    {
        return 'Vehiculos.Consulta';
    }

    protected function setSearchFields()
    {
        return ['descripcion'];
    }

}