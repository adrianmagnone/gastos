<?php

namespace App\Actions;

use Illuminate\Validation\Rules\Enum;

use App\Helpers\DateHelper as MiDate;
use Aiglos\Lba\Actions\EditAction;
use App\Enums\TiposMovimiento;
use App\Enums\PagosMovimiento;
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
            'tipos'      => TiposMovimiento::toArray(),
            'categorias' => \App\Models\Categoria::all(),
            'tiposPagos' => PagosMovimiento::toIconArray()
        ];
    }

    protected function _createModel()
    {
        $model = new $this->model;
        $model->tipo = TiposMovimiento::GASTO;
        $model->tipoPago = PagosMovimiento::TARJETA_DEBITO;

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
            'tipo'         => ['required', new Enum(TiposMovimiento::class)],
            'categoria_id' => ['numeric', 'integer', 'required', 'exists:categorias,id'],
            'descripcion'  => ['string', 'nullable' ],
            'importe'      => ['numeric', 'decimal:2', 'required'],
            'tipoPago'     => ['required', new Enum(PagosMovimiento::class)]
        ];
    }

	public function getRecord() : array
	{
        return  [
            'fecha'        => MiDate::fromFormatTo('d/m/Y', $this->fecha, 'Y-m-d'),
            'tipo'         => $this->request->enum('tipo', TiposMovimiento::class),
            'categoria_id' => $this->categoria_id,
            'descripcion'  => $this->descripcion,
            'importe'      => $this->importe,
            'tipoPago'     => $this->request->enum('tipoPago', PagosMovimiento::class)
        ];
	}

}