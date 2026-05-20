<?php

namespace App\Actions;

use App\Helpers\DateHelper as MiDate;
use Aiglos\Lba\Actions\EditAction;
use App\Models\Movimiento;

class MovimientoEditar extends EditAction
{
    function __construct()
    {
        $this->model = Movimiento::class;

        $this->urlList     = route('movimientos');
        $this->urlSave     = route('movimiento.guardar');
        $this->urlDelete   = route('movimiento.borrar');
        $this->urlBackEdit = 'movimiento/nuevo';

        $this->editView    = 'movimientos.edit';
        $this->deleteView  = 'movimientos.edit';

        $this->updatedMessage = 'El movimiento se ha agregado correctamente!';
        $this->deletedMessage = 'El movimiento se ha borrado correctamente!';
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [
            'tipos'      => Movimiento::TIPOS,
            'categorias' => \App\Models\Categoria::all(),
            'tiposPagos' => [
                [ 'value' => 1,  'text' => Movimiento::TIPOS_PAGOS[1],  'icon' => 'ti ti-cash' ],
                [ 'value' => 2,  'text' => Movimiento::TIPOS_PAGOS[2],  'icon' => 'ti ti-credit-card' ],
                [ 'value' => 3,  'text' => Movimiento::TIPOS_PAGOS[3],  'icon' => 'ti ti-credit-card-hand' ],
                [ 'value' => 4,  'text' => Movimiento::TIPOS_PAGOS[4],  'icon' => 'ti ti-transaction-dollar' ],
                [ 'value' => 5,  'text' => Movimiento::TIPOS_PAGOS[5],  'icon' => 'ti ti-cash-banknote' ],
                [ 'value' => 6,  'text' => Movimiento::TIPOS_PAGOS[6],  'icon' => 'ti ti-wallet' ],
                [ 'value' => 7,  'text' => Movimiento::TIPOS_PAGOS[7],  'icon' => 'ti ti-building-bank' ],
                [ 'value' => 99, 'text' => Movimiento::TIPOS_PAGOS[99], 'icon' => 'ti ti-coin-off'   ] 
            ]
        ];
    }

    protected function _createModel()
    {
        $model = new $this->model;
        $model->tipo = Movimiento::TipoFrom('Gasto');
        return $model;
    }

    protected function prepareForValidation()
    {
        return [
            'importe' => $this->toDecimal('importe')
        ];
    }

    public function rules(): array
    {
        return [
            'fecha'        => ['required', 'date_format:d/m/Y'],
            'tipo'         => ['required', 'in:1,2'],
            'categoria_id' => ['numeric', 'integer', 'required', 'exists:categorias,id'],
            'descripcion'  => ['string', 'nullable' ],
            'importe'      => ['numeric', 'decimal:2', 'required'],
            'tipoPago'     => ['numeric', 'integer', 'required', 'in:0,1,2,3,4,5,6,7']
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
            'tipoPago'     => $this->tipoPago
        ];
	}

}