<?php

namespace App\Actions;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;
use App\Helpers\Formatter;
use App\Models\MovimientoFondo;

class MovimientoFondoImputar extends EditAction
{
    function __construct()
    {
        $this->model = MovimientoFondo::class;

        $this->urlList = route('resumen_fondos');
        $this->urlSave = route('movimientos_fondos.imputar');

        $this->editView   = 'movimientos_fondos.imput';
        $this->deleteView = '';

        $this->updatedMessage = 'El movimiento se ha imputado correctamente!';
        $this->deletedMessage = '';
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        if ($entidad->es_ingreso)
            $posiblesImputaciones = MovimientoFondo::gastosConSaldo($entidad->fondo_id);
        if ($entidad->es_gasto)
            $posiblesImputaciones = MovimientoFondo::ingresosConSaldo($entidad->fondo_id);


        $saldo = (float)$entidad->saldo;
        $listaImputaciones = [];

        foreach ($posiblesImputaciones as $entidadImputar)
        {
            if ($entidadImputar->saldo >= $saldo)
            {
                $listaImputaciones[] = [
                    'id'         => $entidadImputar->id,
                    'importe'    => Formatter::decimalNumber($entidadImputar->saldo),
                    'concepto'   => $entidadImputar->nombre_concepto . ' ' . $entidadImputar->descripcion,
                    'fecha'      => $entidadImputar->fecha_format,
                    'imputacion' => Formatter::decimalNumber($saldo),
                    'saldo'      => Formatter::decimalNumber($entidadImputar->saldo - $saldo),
                ];
                $saldo = 0;
            }
            else
            {
                $listaImputaciones[] = [
                    'id'         => $entidadImputar->id,
                    'importe'    => Formatter::decimalNumber($entidadImputar->saldo),
                    'fecha'      => $entidadImputar->fecha_format,
                    'concepto'   => $entidadImputar->nombre_concepto . ' ' . $entidadImputar->descripcion,
                    'imputacion' => Formatter::decimalNumber($entidadImputar->saldo),
                    'saldo'      => Formatter::decimalNumber(0),
                ];
                $saldo -= $entidadImputar->saldo;
            }
            if ($saldo <= 0)
                break;
        }

        return [
            'imputaciones' => $listaImputaciones,
            'saldo'        => Formatter::decimalNumber($saldo),
        ];
    }

    public function rules(): array
    {
        return [
            'saldo'      => ['numeric', 'decimal:2', 'required'],
        ];
    }

	public function getRecord() : array
	{
        return [
            'saldo' => $this->saldo
        ];
	}

    protected function completeUpdate(&$entidad, &$request)
    {
        foreach($request->imputar as $imputar)
        {
            $movimiento = MovimientoFondo::find($imputar['id']);

            $movimiento->saldo -= $imputar['imputar'];

            $movimiento->save();
        }
    }

}