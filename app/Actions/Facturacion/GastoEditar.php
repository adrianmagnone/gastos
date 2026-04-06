<?php

namespace App\Actions\Facturacion;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;

use App\Models\CuentaCorriente;
use App\Models\Imputacion;

class GastoEditar extends EditAction
{
    protected $movimiento;
    protected $importeImputar;

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
            'movimiento'   => CuentaCorriente::find($this->movimiento),
            'tipoComprobanteGasto' => config('define.comprobantes.gastos'),
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
            'tipoComprobante_id' => ['required', 'numeric', 'integer', 'exists:tipos_comprobantes,id'],
        ];
    }

	public function getRecord() : array
	{
        $this->movimiento = CuentaCorriente::find($this->idMovimiento);
        
        $this->importeImputar = \min((float)$this->importe, (float)$this->movimiento->saldo);

        return [
            'cuenta_id'                  => $this->cuenta_id,
            'fecha'                      => $this->dateOrNull('fecha'),
            'tipoComprobante_id'         => $this->tipoComprobante_id,
            'puntoVenta'                 => 1,
            'numeroComprobante'          => CuentaCorriente::ultimoNumeroGasto($this->tipoComprobante_id) + 1,
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
            'saldo'                      => $this->importe - $this->importeImputar,
            'columna'                    => 'H',
        ];
	}

    protected function completeUpdate(&$entidad, &$request)
    {
        $imputar = [
            'comprobante_debe'  => $this->idMovimiento,
            'comprobante_haber' => $entidad->id,
            'importe'           => $this->importeImputar,
        ];
        Imputacion::create($imputar);

        $this->movimiento->saldo -= $this->importeImputar;
        $this->movimiento->save();
    }
}