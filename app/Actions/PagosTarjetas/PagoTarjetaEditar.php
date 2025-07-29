<?php

namespace App\Actions\PagosTarjetas;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;

use App\Models\CompraTarjeta;
use App\Models\PagoTarjeta;
use App\Models\DetallePagoTarjeta;

class PagoTarjetaEditar extends EditAction
{
    function __construct()
    {
        $this->model = PagoTarjeta::class;

        $this->urlList = route('resumen_tarjetas');
        $this->urlSave = route('pago_tarjeta.guardar');

        $this->editView   = 'pagos_tarjetas.edit';
        $this->deleteView = '';

        $this->updatedMessage = 'El Pago de Tarjeta de Credito se ha editado correctamente!';
        $this->deletedMessage = '';
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [
            'listaTarjetas'   => \App\Models\Tarjeta::activas()
        ];
    }

    protected function prepareForValidation()
    {
        return [
            'totalCuotas'  => $this->toDecimal('totalCuotas'),
            'totalPagado'  => $this->toDecimal('totalPagado'),
            'totalSeguros' => $this->toDecimal('totalSeguros')
        ];
    }

    public function rules(): array
    {
        return [
            'tarjeta_id'      => ['numeric', 'integer', 'required', 'exists:tarjetas,id'],
            'periodoPago'     => ['required', 'date_format:d/m/Y'],
            'fechaPago'       => ['date_format:d/m/Y', 'nullable'],
            'totalCuotas'     => ['numeric', 'decimal:2', 'required', 'gt:0'],
            'totalPagado'     => ['numeric', 'decimal:2', 'required', 'gt:0'],
            'totalSeguros'    => ['numeric', 'decimal:2', 'required'],
        ];
    }

	public function getRecord() : array
	{
        return [
            'tarjeta_id'      => $this->tarjeta_id,
            'periodoPago'     => MiDate::fromFormatTo('d/m/Y', $this->periodoPago, 'Y-m-d'),
            'fechaPago'       => $this->dateOrNull('fechaPago'),
            'totalCuotas'     => $this->totalCuotas,
            'totalPagado'     => $this->totalPagado,
            'totalSeguros'    => $this->totalSeguros
        ];
	}

    protected function completeUpdate(&$entidad, &$request)
    {
        foreach ($this->check as $id => $valor)
        {
            $gasto = CompraTarjeta::find($id);

            $gasto->cuotasPendientes -= (int)$this->cantidad[$id];
            $gasto->save();

            $detalle = [
                'pago_id'   => $entidad->id,
                'compra_id' => $id,
                'cantidad'  => (int)$this->cantidad[$id],
                'importe'   => $this->valueToDecimal($this->pagar[$id]),
            ];

            DetallePagoTarjeta::create($detalle);
        } 
    }
}