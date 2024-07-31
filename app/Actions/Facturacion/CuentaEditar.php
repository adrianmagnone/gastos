<?php

namespace App\Actions\Facturacion;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;
use App\Models\Cuenta;

class CuentaEditar extends EditAction
{
    function __construct()
    {
        $this->model = Cuenta::class;

        $this->urlList = route('cuentas');
        $this->urlSave = route('cuenta.guardar');

        $this->editView   = 'cuentas.edit';
        $this->deleteView = '';

        $this->updatedMessage = 'La cuenta se ha editado correctamente!';
        $this->deletedMessage = '';
    }

    public function rules(): array
    {
        return [
            'nombre'   => ['required', 'string'],
            'estado'   => ['in:on', 'nullable'],   
        ];
    }

	public function getRecord() : array
	{
        return [
            'nombre'   => $this->nombre,
            'estado'   => $this->onOff('estado'),   
        ];
	}

}