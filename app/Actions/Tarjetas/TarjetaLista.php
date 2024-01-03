<?php

namespace App\Actions\Tarjetas;

use App\Lib\Actions\SelectAction;
use App\Models\Tarjeta;
 
class TarjetaLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'tarjetas.index';
        parent::__construct(Tarjeta::class);
    }

    public function requestKey()
    {
        return 'Tarjetas.Consulta';
    }

    protected function setSearchFields()
    {
        return ['nombre'];
    }

}