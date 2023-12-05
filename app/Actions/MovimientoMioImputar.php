<?php

namespace App\Actions;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;
use App\Helpers\Formatter;
use App\Models\MovimientoMio;

class MovimientoMioImputar extends EditAction
{
    function __construct()
    {
        $this->model = MovimientoMio::class;

        $this->urlList = route('resumen_mio');
        $this->urlSave = route('movimientos_mios.imputar');

        $this->editView   = 'movimientos_mios.imput';
        $this->deleteView = '';

        $this->updatedMessage = 'El movimiento se ha imputado correctamente!';
        $this->deletedMessage = '';
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        if ($entidad->es_ingreso)
            $posiblesImputaciones = MovimientoMio::gastosConSaldo();
        if ($entidad->es_gasto)
            $posiblesImputaciones = MovimientoMio::ingresosConSaldo();


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
            $movimiento = MovimientoMio::find($imputar['id']);

            $movimiento->saldo -= $imputar['imputar'];

            $movimiento->save();
        }
    }

}