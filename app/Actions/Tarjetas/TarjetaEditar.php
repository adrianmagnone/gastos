<?php

namespace App\Actions\Tarjetas;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;
use App\Models\Tarjeta;

class TarjetaEditar extends EditAction
{
    function __construct()
    {
        $this->model = Tarjeta::class;

        $this->urlList = route('tarjetas');
        $this->urlSave = route('tarjeta.guardar');

        $this->editView   = 'tarjetas.edit';
        $this->deleteView = '';

        $this->updatedMessage = 'La Tarjeta de Credito ha editada correctamente!';
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