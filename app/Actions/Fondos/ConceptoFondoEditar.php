<?php

namespace App\Actions\Fondos;

use App\Lib\Actions\EditAction;
use App\Models\ConceptoFondo;

class ConceptoFondoEditar extends EditAction
{
    function __construct()
    {
        $this->model = ConceptoFondo::class;

        $this->urlList = route('conceptos_fondos');
        $this->urlSave = route('conceptos_fondos.guardar');

        $this->editView   = 'conceptos_fondos.edit';
        $this->deleteView = '';

        $this->updatedMessage = 'El Concepto se ha agregado correctamente!';
        $this->deletedMessage = '';
    }


    public function rules(): array
    {
        return [
            'nombre'  => ['string', 'required' ],
        ];
    }

	public function getRecord() : array
	{
        return [
            'nombre' => $this->nombre
        ];
	}

}