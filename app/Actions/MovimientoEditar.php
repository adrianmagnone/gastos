<?php

namespace App\Actions;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;
use App\Models\Movimiento;

class MovimientoEditar extends EditAction
{
    function __construct()
    {
        $this->model = Movimiento::class;

        $this->urlList = route('movimientos');
        $this->urlSave = route('movimiento.guardar');

        $this->editView   = 'movimientos.edit';
        $this->deleteView = '';

        $this->updatedMessage = 'El movimiento se ha agregado correctamente!';
        $this->deletedMessage = '';
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [
            'tipos'      => Movimiento::TIPOS,
            'categorias' => \App\Models\Categoria::all(),
        ];
    }

    protected function _createModel()
    {
        $model = new $this->model;
        $model->tipo = Movimiento::Tipo('Gasto');
        return $model;
    }

    public function rules(): array
    {
        return [
            'fecha'        => ['required', 'date_format:d/m/Y'],
            'tipo'         => ['required', 'in:1,2'],
            'categoria_id' => ['numeric', 'integer', 'required', 'exists:categorias,id'],
            'descripcion'  => ['string', 'nullable' ],
            'importe'      => ['numeric', 'decimal:2', 'required'],
        ];
    }

	public function getRecord() : array
	{
        return  [
            'fecha'        => MiDate::fromFormatTo('d/m/Y', $this->fecha, 'Y-m-d'),
            'tipo'         => $this->tipo,
            'categoria_id' => $this->categoria_id,
            'descripcion'  => $this->descripcion,
            'importe'      => $this->importe,
        ];
	}

}