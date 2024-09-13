<?php

namespace App\Actions\Facturacion;

use DB;
use App\Lib\Actions\ImportFileAction;
use Illuminate\Support\Facades\Storage;
use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

use App\Models\CuentaCorriente;
use App\Models\Cuenta;
use App\Models\Persona;
use App\Models\TipoComprobante;


class CuentaCorrienteImportarPagos extends ImportFileAction
{
    use \App\Lib\Import\ReadCsvBase;

    function __construct()
    {
        $this->model = CuentaCorriente::class;
        $this->reader = \App\Lib\Import\ReadTextBase::class;

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
                2 => 'Banco Hipotecario'
            ]
        ];
    }

    public function rulesFile(): array
    {
        return [
            'banco'        => ['numeric', 'integer', 'in:1,2', 'required'],
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
        match ((int)$this->banco) {
            1 => $this->procesarBancoMacro($record),
            2 => $this->procesarBancoHipotecacio($record),
        };
    }

        /*
    * 0 => string '09/10/2023' (length=10)   Fecha del movimiento
    * 1 => string '69200' (length=5)         Identificacion o tipo de movimiento
    * 2 => string 'SANCOR SALUD' (length=12) Descripcion
    * 3 => string '-15092,13' (length=9)     Importe del movimiento
    * 4 => string '146810,76' (length=9)     Saldo
    */
    protected function procesarBancoMacro($record)
    {
        $importe = (float)str_replace (',', '.', $record[3]);
        $cuit    = '';
        
        if (preg_match('/[0-9]{8,11}/', $record[2], $matches))
        {
            $cuit = $matches[0];
        }

        if ($importe > 0)
        {
            $this->data[] = [
                'importe'         => $importe,
                'importeFormat'   => Formatter::moneyArg($importe),
                'fecha'           => $record[0],
                'descripcion'     => $record[2],
                'cuit'            => $cuit
            ];
        }
    }

    /*
    * 0 => string '' (length=0)
    * 1 => string '28/09/2023' (length=10)        Fecha
    * 2 => string '' (length=0)
    * 3 => string 'MERCADOPAGO*MCART' (length=0)  Descripcion del Movimiento
    * 4 => string '' (length=0)
    * 5 => string '' (length=0)
    * 6 => string '' (length=0)
    * 7 => string '' (length=0)
    * 8 => string '' (length=0)
    * 9 => string '' (length=0)
    * 10 => string '' (length=0)
    * 11 => string '' (length=0)
    * 12 => string '' (length=0)
    * 13 => string '' (length=0)
    * 14 => string '-6250' (length=5)             Importe del Movimiento
    * 15 => string '' (length=0)
    * 16 => string '20699,67' (length=8)          Saldo 
    */
    protected function procesarBancoHipotecacio($record)
    {
        $importe = (float)str_replace (',', '.', $record[14]);

        $cuit    = '';
        
        if (preg_match('/[0-9]{8,11}/', $record[3], $matches))
        {
            $cuit = $matches[0];
        }

        if ($importe > 0)
        {
            $this->data[] = [
                'importe'         => $importe,
                'importeFormat'   => Formatter::moneyArg($importe),
                'fecha'           => $record[1],
                'descripcion'     => $record[3],
                'cuit'            => $cuit
            ];
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

    // protected function executeSaveOneByOne(&$records)
    // {
    //     \DB::beginTransaction();

    //     $cantidad = 0;
    //     $recibo   = 1;

    //     // Obtener el ultimo numero de recibo
    //     $ultimoRecibo = CuentaCorriente::where('tipoComprobante_id', 14)
    //                                    ->where('puntoVenta', 1)
    //                                    ->orderBy('numeroComprobante', 'desc')
    //                                    ->first();

    //     if ($ultimoRecibo)
    //     {
    //         $recibo = $ultimoRecibo->numeroComprobante + 1;
    //     }

    //     try
    //     {
    //         foreach ($this->comprobante as $id => $comprobante)
    //         {
    //             $persona = Persona::findByIdFiscal($comprobante['idComprador']);
    //             // Recibo C
    //             $tipoComprobante = TipoComprobante::find(14);

    //             $record= [
    //                 'cuenta_id'                  => $this->cuenta_id,
    //                 'fecha'                      => MiDate::fromFormatTo('Ymd', $comprobante['fecha'], 'Y-m-d'),
    //                 'tipoComprobante_id'         => $comprobante['tipoComprobante'],
    //                 'puntoVenta'                 => 1,
    //                 'numeroComprobante'          => $recibo++,
    //                 'tipoDocumento'              => $persona->tipoDocumento,
    //                 'identificadorComprador'     => $comprobante['idComprador'],
    //                 'persona_id'                 => $persona->id,
    //                 'importe'                    => $comprobante['importe'],
    //                 'importePercepcion'          => 0,
    //                 'importeNoGravado'           => 0,
    //                 'importeExento'              => 0,
    //                 'importePercepcionNacional'  => 0,
    //                 'importePercepcionIB'        => 0,
    //                 'importePercepcionMunicipal' => 0,
    //                 'importeImpuestoInterno'     => 0,
    //                 'saldo'                      => $comprobante['importe'],
    //                 'columna'                    => 'H',
    //             ];

    //             CuentaCorriente::create($record);
    //             $cantidad++;
    //         }

    //         \DB::commit();

    //         $this->updatedMessage = "Se han importado {$cantidad} movimientos de pagos correctamente.";
    //         return true;
    //     }
    //     catch(\Throwable $th)
    //     {
    //         \DB::rollback();
    //         dd($th->getMessage());
    //     }
    // }
}