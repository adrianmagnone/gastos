<?php

namespace App\Actions\Facturacion;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;

use App\Models\CuentaCorriente;
use App\Models\Imputacion;

class GastoEditar extends EditAction
{
    protected $movimiento;

    function __construct()
    {
        $this->model = CuentaCorriente::class;

        $this->urlList = route('cuentas_corrientes');
        $this->urlSave = route('cuenta_corriente.guardar_gasto');

        $this->editView   = 'cuentas_corrientes.gastos';
        $this->deleteView = '';

        $this->updatedMessage = 'El Gasto Administrativo se ha agregado correctamente!';
        $this->deletedMessage = '';
    }

    public function setMovimiento($id)
    {
        $this->movimiento = (int)$id;
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [
            'movimiento'   => CuentaCorriente::find($this->movimiento)
        ];
    }

    protected function prepareForValidation()
    {
        return [
            'importe' => $this->toDecimal('importe'),
        ];
    }

    public function rules(): array
    {
        return [
            'fecha'       => ['date_format:d/m/Y', 'nullable'],
            'importe'     => ['numeric', 'decimal:2', 'required'],
        ];
    }

	public function getRecord() : array
	{
        return [
            'cuenta_id'                  => $this->cuenta_id,
            'fecha'                      => $this->dateOrNull('fecha'),
            'tipoComprobante_id'         => config('define.comprobantes.gastos'),
            'puntoVenta'                 => 1,
            'numeroComprobante'          => CuentaCorriente::ultimoNumeroGasto() + 1,
            'tipoDocumento'              => $this->tipoDocumento,
            'identificadorComprador'     => $this->identificadorComprador,
            'persona_id'                 => $this->persona_id,
            'importe'                    => $this->importe,
            'importePercepcion'          => 0,
            'importeNoGravado'           => 0,
            'importeExento'              => 0,
            'importePercepcionNacional'  => 0,
            'importePercepcionIB'        => 0,
            'importePercepcionMunicipal' => 0,
            'importeImpuestoInterno'     => 0,
            'saldo'                      => 0,
            'columna'                    => 'H',
        ];
	}

    protected function completeUpdate(&$entidad, &$request)
    {
        $imputar = [
            'comprobante_debe'  => $this->idMovimiento,
            'comprobante_haber' => $entidad->id,
            'importe'           => $this->importe,
        ];
        Imputacion::create($imputar);

        $movimiento = CuentaCorriente::find($this->idMovimiento);
        $movimiento->saldo -= $this->importe;
        $movimiento->save();
    }
}