<?php

namespace App\Actions\Conceptos;

use App\Lib\Actions\EditAction;
use App\Models\ConceptoMio;

class ConceptoMioEditar extends EditAction
{
    function __construct()
    {
        $this->model = ConceptoMio::class;

        $this->urlList = route('conceptos_mios');
        $this->urlSave = route('conceptos_mios.guardar');

        $this->editView   = 'conceptos_mios.edit';
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