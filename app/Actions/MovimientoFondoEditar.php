<?php

namespace App\Actions;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\InsertMultipleAction;
use App\Models\MovimientoFondo;

class MovimientoFondoEditar extends InsertMultipleAction
{
    function __construct()
    {
        $this->model = MovimientoFondo::class;

        $this->urlList = route('resumen_fondos');
        $this->urlSave = route('movimientos_fondos.guardar');

        $this->editView   = 'movimientos_fondos.edit';
        $this->deleteView = '';

        $this->updatedMessage = 'El movimiento se ha agregado correctamente!';
        $this->deletedMessage = '';
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [
            'listaFondos' => \App\Models\Fondo::activos(),
            'tipos'       => MovimientoFondo::TIPOS,
            'conceptos'   => \App\Models\ConceptoFondo::all(),
        ];
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
            'concepto_id'  => ['numeric', 'integer', 'required', 'exists:conceptos_mios,id'],
            'fondo_id'     => ['numeric', 'integer', 'required', 'exists:fondos,id'],
            'descripcion'  => ['string', 'nullable' ],
            'importe'      => ['numeric', 'decimal:2', 'required'],
            'cuotas'       => ['required', 'integer'],
        ];
    }

	public function getRecords() : array
	{
        $records = [];

        $fecha     = MiDate::fromFormatTo('d/m/Y', $this->fecha, 'Y-m-d');
        $cuotas    = (int)$this->cuotas;
        $importeCuota = $this->importe / $cuotas;

        for ($i = 1; $i <= $cuotas ; $i++)
        { 
            $fechaCuota = MiDate::addMonths($i - 1, $fecha);

            $records[] = [
                'fecha'       => $fechaCuota,
                'tipo'        => $this->tipo,
                'concepto_id' => $this->concepto_id,
                'fondo_id'    => $this->fondo_id,
                'descripcion' => ($cuotas == 1) ?  $this->descripcion : "{$this->descripcion} Cuota {$i} de {$cuotas}",
                'importe'     => $importeCuota,
                'saldo'       => $importeCuota,
            ];
        }

        return $records;
	}

}