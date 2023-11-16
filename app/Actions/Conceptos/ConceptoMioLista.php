<?php

namespace App\Actions\Conceptos;

use App\Lib\Actions\SelectAction;
use App\Models\ConceptoMio;
 
class ConceptoMioLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'conceptos_mios.index';
        parent::__construct(ConceptoMio::class);
    }

    public function requestKey()
    {
        return 'ConceptoMio.Consulta';
    }

    protected function setSearchFields()
    {
        return ['nombre'];
    }

}