<?php

namespace App\Actions\GastosTarjetas;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;
use App\Models\CompraTarjeta;

class GastoTarjetaEditar extends EditAction
{
    function __construct()
    {
        $this->model = CompraTarjeta::class;

        $this->urlList = route('gastos_tarjetas');
        $this->urlSave = route('gasto_tarjeta.guardar');

        $this->editView   = 'gastos_tarjetas.edit';
        $this->deleteView = '';

        $this->updatedMessage = 'El Gasto con Tarjeta de Credito se ha editado correctamente!';
        $this->deletedMessage = '';
    }

    protected function _createModel()
    {
        $hoy = MiDate::object();

        if ($hoy->day < 23)
            $periodo = MiDate::object('first day of next month');
        else
            $periodo = MiDate::object('first day of +2 month');

        $compra = new $this->model;
        $compra->periodoInicial = $periodo->format('Y-m-d');

        return $compra;
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [
            'listaTarjetas'   => \App\Models\Tarjeta::activas(),
            'listaCategorias' => \App\Models\Categoria::paraEgresos()
        ];
    }

    protected function prepareForValidation()
    {
        return [
            'total' => $this->toDecimal('total')
        ];
    }

    public function rules(): array
    {
        return [
            'tarjeta_id'      => ['numeric', 'integer', 'required', 'exists:tarjetas,id'],
            'categoria_id'    => ['numeric', 'integer', 'required', 'exists:categorias,id'],
            'fecha'           => ['required', 'date_format:d/m/Y'],
            'descripcion'     => ['required', 'string'],
            'total'           => ['numeric', 'decimal:2', 'required', 'gt:0'],
            'cuotas'          => ['numeric', 'integer', 'required'],
            'periodoInicial'  => ['required', 'date_format:d/m/Y']
        ];
    }

	public function getRecord() : array
	{
        $importeCuota = (float)$this->total / (float)$this->cuotas;

        $record = [
            'tarjeta_id'      => $this->tarjeta_id,
            'categoria_id'    => $this->categoria_id,
            'fecha'           => MiDate::fromFormatTo('d/m/Y', $this->fecha, 'Y-m-d'),
            'descripcion'     => $this->descripcion,
            'total'           => $this->total,
            'cuotas'          => $this->cuotas,
            'importeCuota'    => $importeCuota,
            'periodoInicial'  => MiDate::fromFormatTo('d/m/Y', $this->periodoInicial, 'Y-m-d'),
        ];

        if (! $this->id)
        {
            $record['cuotasPendientes'] = $this->cuotas;
        }

        return $record;
	}

}