<?php

namespace App\Actions\Facturacion;

use DB;
use Aiglos\Lba\Actions\ImportFileAction;
use Illuminate\Support\Facades\Storage;
use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

use App\Models\CuentaCorriente;
use App\Models\Cuenta;
use App\Models\Persona;
use App\Models\TipoComprobante;


class CuentaCorrienteImportarPagos extends ImportFileAction
{
    use \Aiglos\Lba\Import\ReadCsvBase;

    function __construct()
    {
        $this->model = CuentaCorriente::class;

        $this->urlList   = route('cuentas_corrientes');
        $this->urlImport = 'cuenta_corriente/archivo_pagos';
        $this->urlSave   = 'cuenta_corriente/guardar_pagos';

        $this->loadView  = 'cuentas_corrientes.import_pagos';
        $this->editView  = 'cuentas_corrientes.import_pagos2';

        $this->skipRows  = 1;

        $this->updatedMessage = 'Los Movimientos se han importado correctamente.';
    }

    protected function aditionalDataForLoad()
    {
        return [
            'listaBancos' => [
                1 => 'Banco Macro',
                2 => 'Banco Hipotecario',
                3 => 'Banco Hipotecario 2026'
            ]
        ];
    }

    public function rulesFile(): array
    {
        return [
            'banco'        => ['numeric', 'integer', 'in:1,2,3', 'required'],
            'fileIngresos' => ['required', 'mimes:csv', 'max:2048'],
        ];
    }

    protected function loadFile()
    {
        if ($this->request->hasFile('fileIngresos'))
        {
            return Storage::disk('local')->putFileAs(
                'importar/pagos',
                $this->request->file('fileIngresos'),
                $this->request->fileIngresos->getClientOriginalName()
    );
        }
        return false;
    }

    public function processRecord($record)
    {
        $registro = match ((int)$this->banco) {
            1 => \App\Lib\ArchivoBancos\LeerRegistros::BancoMacro($record),
            2 => \App\Lib\ArchivoBancos\LeerRegistros::BancoHipotecario($record),
            3 => \App\Lib\ArchivoBancos\LeerRegistros::BancoHipotecario2026($record),
        };

        if ($registro && $registro['tipo'] === 'Ingreso')
        {
            $persona = Persona::findByCuit($registro['cuit']);
            $registro['persona'] = ($persona) ? $persona->abreviatura : '';
            $this->data[] = $registro;
        }
    }
 
    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [
            'cuentas'  => \App\Models\Cuenta::activas(),
        ];
    }

    public function rules(): array
    {
        return [
            'cuenta_id'    => ['exists:App\Models\Cuenta,id', 'numeric', 'integer', 'required'],
            'check'        => ['required', 'array', 'min:1'],
            'fecha'        => ['required', 'array', 'min:1'],
            'descripcion'  => ['array'],
            'importe'      => ['required', 'array', 'min:1'],
        ];
    }


    public function getRecords() : array
    {
        $records = [];

        $recibo          = CuentaCorriente::ultimoNumeroRecibo() + 1;
        $tipoComprobante = TipoComprobante::find(14);

        foreach($this->check as $index => $check)
        {
            $persona = Persona::findByIdFiscal($this->idComprador[$index]);

            if (! $persona)
                continue;

            $records[] = [
                'cuenta_id'                  => $this->cuenta_id,
                'fecha'                      => MiDate::fromFormatTo('d/m/Y', $this->fecha[$index], 'Y-m-d'),
                'tipoComprobante_id'         => $tipoComprobante->id,
                'puntoVenta'                 => 1,
                'numeroComprobante'          => $recibo++,
                'tipoDocumento'              => $persona->tipoDocumento,
                'identificadorComprador'     => $persona->identificador,
                'persona_id'                 => $persona->id,
                'importe'                    => $this->importe[$index],
                'importePercepcion'          => 0,
                'importeNoGravado'           => 0,
                'importeExento'              => 0,
                'importePercepcionNacional'  => 0,
                'importePercepcionIB'        => 0,
                'importePercepcionMunicipal' => 0,
                'importeImpuestoInterno'     => 0,
                'saldo'                      => $this->importe[$index],
                'columna'                    => 'H',
            ];
        }

        return $records;
    }
}