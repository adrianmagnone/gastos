<?php

namespace App\Actions\Fondos;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;
use App\Models\Fondo;

class FondoEditar extends EditAction
{
    function __construct()
    {
        $this->model = Fondo::class;

        $this->urlList = route('fondos');
        $this->urlSave = route('fondo.guardar');

        $this->editView   = 'fondos.edit';
        $this->deleteView = '';

        $this->updatedMessage = 'El Fondo se ha editado correctamente!';
        $this->deletedMessage = '';
    }


    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string'],
            'estado' => ['in:on', 'nullable'],   
        ];
    }

	public function getRecord() : array
	{
        return [
            'nombre' => $this->nombre,
            'estado' => $this->onOff('estado'),   
        ];
	}

}