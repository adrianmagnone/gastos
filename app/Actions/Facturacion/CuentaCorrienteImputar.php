<?php

namespace App\Actions\Facturacion;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;
use App\Helpers\Formatter;

use App\Models\CuentaCorriente;
use App\Models\Imputacion;

class CuentaCorrienteImputar extends EditAction
{
    function __construct()
    {
        $this->model = CuentaCorriente::class;

        $this->urlList = route('cuentas_corrientes');
        $this->urlSave = route('cuenta_corriente.imputar');

        $this->editView   = 'cuentas_corrientes.imput';
        $this->deleteView = '';

        $this->updatedMessage = 'El movimiento se ha imputado correctamente!';
        $this->deletedMessage = '';
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        if ($entidad->columna == 'D')
            $posiblesImputaciones = CuentaCorriente::haberConSaldo($entidad->cuenta_id, $entidad->persona_id); 
        else
            $posiblesImputaciones = CuentaCorriente::debeConSaldo($entidad->cuenta_id, $entidad->persona_id);

        return [
            'imputaciones' => $posiblesImputaciones
        ];
    }

    // protected function prepareForValidation()
    // {
    //     dd($this->toDecimal('nuevoSaldo'));
    //     return [
    //         'nuevoSaldo' => $this->toDecimal('nuevoSaldo')
    //     ];
    // }

    public function rules(): array
    {
        return [
            // 'saldo'      => ['numeric', 'decimal:2', 'required'],
            // 'nuevoSaldo' => ['numeric', 'decimal:2', 'gte:0'],
        ];
    }

	public function getRecord() : array
	{
        return [
            'saldo' => $this->nuevoSaldo
        ];
	}

    protected function completeUpdate(&$entidad, &$request)
    {
        $columnaEntidad    = ($entidad->columna == 'D') ? 'comprobante_debe' : 'comprobante_haber';
        $columnaMovimiento = ($entidad->columna == 'D') ? 'comprobante_haber' : 'comprobante_debe';

        foreach($this->check as $index => $check)
        {
            $movimiento = CuentaCorriente::find($index);
            $importe = $this->valueToDecimal($this->reimputar[$index]);

            $movimiento->saldo -= $importe;
            $movimiento->save();

            $imputar = [
                $columnaEntidad    => $entidad->id,
                $columnaMovimiento => $movimiento->id,
                'importe'          => $importe,
            ];

            Imputacion::create($imputar);
        }
    }

}