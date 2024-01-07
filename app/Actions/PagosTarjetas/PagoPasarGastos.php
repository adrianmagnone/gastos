<?php

namespace App\Actions\PagosTarjetas;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\ProcessOneAction;

use App\Models\PagoTarjeta;
use App\Models\Movimiento;

class PagoPasarGastos extends ProcessOneAction
{
    function __construct()
    {
        $this->model = PagoTarjeta::class;

        $this->urlList = route('movimientos_mensuales');

        $this->updatedMessage = 'El Pago de Tarjeta se ha pasado correctamente a Gastos!';
    }


    protected function processEntidad()
    {
        // pasamos cada uno de los gastos

        foreach ($this->entidad->detalle as $detalle)
        {
            $gasto = [
                'fecha'        => $this->entidad->fechaPago,
                'tipo'         => 2,
                'categoria_id' => $detalle->categoria_id,
                'descripcion'  => $detalle->compra_descripcion,
                'importe'      => $detalle->importe
            ];
            Movimiento::create($gasto);
        }

        // pasamos el seguro de la tarjeta
        $gastoSeguro = [
            'fecha'        => $this->entidad->fechaPago,
            'tipo'         => 2,
            'categoria_id' => config('define.categorias.seguros'),
            'descripcion'  => 'Tarjeta',
            'importe'      => $this->entidad->totalSeguros
        ];
        Movimiento::create($gastoSeguro);

        // pasamos los gastos de tarjeta
        $gastoTarjeta = [
            'fecha'        => $this->entidad->fechaPago,
            'tipo'         => 2,
            'categoria_id' => config('define.categorias.tarjeta'),
            'descripcion'  => $this->entidad->descripcion_tarjeta,
            'importe'      => $this->entidad->total_gastos
        ];
        Movimiento::create($gastoTarjeta);

        $this->entidad->pasadoGasto = 1;
        $this->entidad->save();
    }
}