<?php

namespace App\Actions\Facturacion;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;

use App\Models\CategoriaMonotributo;

class MonotributoEditar extends EditAction
{
    function __construct()
    {
        $this->model = CategoriaMonotributo::class;

        $this->urlList = route('monotributo');
        $this->urlSave = route('monotributo.guardar');

        $this->editView   = 'categorias_monotributo.edit';
        $this->deleteView = '';

        $this->updatedMessage = 'Categoria de Monotributo se ha agregado correctamente!';
        $this->deletedMessage = '';
    }

    protected function prepareForValidation()
    {
        return [
            'importe' => $this->toDecimal('importe'),
        ];
    }

    public function rules(): array
    {
        return [
            'fecha'       => ['date_format:d/m/Y', 'required' ],
            'categoria'   => ['required', 'size:1' ],
            'importe'     => ['numeric', 'decimal:2', 'required'],
        ];
    }

	public function getRecord() : array
	{
        return [
            'fecha_vigencia'  => $this->dateOrNull('fecha'),
            'categoria'       => \strtoupper($this->categoria),
            'importe_mensual' => $this->importe / 12,
            'importe_anual'   => $this->importe
        ];
	}
}