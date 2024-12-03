<?php

namespace App\Actions\Personas;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;
use App\Models\Persona;

class PersonaEditar extends EditAction
{
    function __construct()
    {
        $this->model = Persona::class;

        $this->urlList = route('personas');
        $this->urlSave = route('persona.guardar');

        $this->editView   = 'personas.edit';
        $this->deleteView = '';

        $this->updatedMessage = 'La Persona se ha editado correctamente!';
        $this->deletedMessage = '';
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [
            'listaTipos' => [
                80 => 'CUIT',
                87 => 'CDI',
                91 => 'CI Extranjera',
                94 => 'Pasaporte',
                96 => 'DNI',
                99 => 'Otro',
            ]
        ];
    }

    public function rules(): array
    {
        return [
            'nombre'        => ['required', 'string'],
            'abreviatura'   => ['string'],
            'tipoDocumento' => ['integer', 'in:80,87,91,94,96,99', 'required'], 
            'identificador' => ['numeric', 'required'],
            'cuitPagador'   => ['numeric', 'nullable'],
        ];
    }

	public function getRecord() : array
	{
        return [
            'nombre'        => $this->nombre,
            'abreviatura'   => $this->abreviatura,
            'tipoDocumento' => $this->tipoDocumento,
            'identificador' => $this->identificador,
            'cuitPagador'   => $this->cuitPagador
        ];
	}

}