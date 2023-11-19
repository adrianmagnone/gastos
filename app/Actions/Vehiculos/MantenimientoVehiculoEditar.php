<?php

namespace App\Actions\Vehiculos;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;
use App\Models\MantenimientoVehiculo;

class MantenimientoVehiculoEditar extends EditAction
{
    function __construct()
    {
        $this->model = MantenimientoVehiculo::class;

        $this->urlList = route('mantenimiento_vehiculos');
        $this->urlSave = route('mantenimiento_vehiculo.guardar');

        $this->editView   = 'mantenimiento_vehiculos.edit';
        $this->deleteView = '';

        $this->updatedMessage = 'El movimiento de Mantenimiento de Vehículo se ha editado correctamente!';
        $this->deletedMessage = '';
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [
            'listaVehiculos'  => \App\Models\Vehiculo::activos(),
        ];
    }

    public function rules(): array
    {
        return [
            'fecha'       => ['required', 'date_format:d/m/Y'],
            'vehiculo_id' => ['required', 'integer', 'exists:vehiculos,id'],
            'km'          => ['required', 'integer'],
            'importe'     => ['required', 'decimal:2'],
            'descripcion' => ['required', 'string'],
        ];
    }

	public function getRecord() : array
	{
        return [
            'fecha'       => MiDate::fromFormatTo('d/m/Y', $this->fecha, 'Y-m-d'),
            'vehiculo_id' => $this->vehiculo_id,
            'km'          => $this->km,
            'importe'     => $this->importe,
            'descripcion' => $this->descripcion,
        ];
	}

}