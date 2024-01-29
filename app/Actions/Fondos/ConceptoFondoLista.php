<?php

namespace App\Actions\Fondos;

use App\Lib\Actions\SelectAction;
use App\Models\ConceptoFondo;
 
class ConceptoFondoLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'conceptos_fondos.index';
        parent::__construct(ConceptoFondo::class);
    }

    public function requestKey()
    {
        return 'ConceptoFondos.Consulta';
    }

    protected function setSearchFields()
    {
        return ['nombre'];
    }

}