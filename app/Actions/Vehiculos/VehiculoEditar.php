<?php

namespace App\Actions\Vehiculos;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;
use App\Models\Vehiculo;

class VehiculoEditar extends EditAction
{
    function __construct()
    {
        $this->model = Vehiculo::class;

        $this->urlList = route('vehiculos');
        $this->urlSave = route('vehiculo.guardar');

        $this->editView   = 'vehiculos.edit';
        $this->deleteView = '';

        $this->updatedMessage = 'El Vehículo se ha editado correctamente!';
        $this->deletedMessage = '';
    }

    public function rules(): array
    {
        return [
            'descripcion' => ['required', 'string'],
            'modelo'      => ['required', 'integer'],
            'patente'     => ['required', 'string'],
            'color'       => ['required', 'string'],
            'estado'      => ['in:on', 'nullable'],   
        ];
    }

	public function getRecord() : array
	{
        return [
            'descripcion' => $this->descripcion,
            'modelo'      => $this->modelo,
            'patente'     => $this->patente,
            'color'       => $this->color,
            'estado'      => $this->onOff('estado'),   
        ];
	}

}