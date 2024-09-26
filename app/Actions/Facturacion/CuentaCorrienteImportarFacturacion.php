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


class CuentaCorrienteImportarFacturacion extends ImportFileAction
{
    use \App\Lib\Import\ReadTextBase;

    function __construct()
    {
        $this->model = CuentaCorriente::class;
        $this->reader = \App\Lib\Import\ReadTextBase::class;

        $this->urlList   = route('cuentas_corrientes');
        $this->urlImport = 'cuenta_corriente/archivo_facturacion';
        $this->urlSave   = 'cuenta_corriente/guardar_facturacion';

        $this->loadView  = 'cuentas_corrientes.import_fact';
        $this->editView  = 'cuentas_corrientes.import_fact2';

        $this->skipRows  = 0;

        $this->updatedMessage = 'Los Movimientos se han importado correctamente.';
    }

    protected function loadFile()
    {
        if ($this->request->hasFile('fileAfip'))
        {
            return Storage::disk('local')->putFileAs(
                        'importar/afip',
                        $this->request->file('fileAfip'),
                        $this->request->fileAfip->getClientOriginalName()
            );
        }
        return false;
    }

    protected function aditionalDataForLoad()
    {
        return [
            'cuentas'  => Cuenta::activas(),
        ];
    }

    public function rulesFile(): array
    {
        return [
            'cuenta_id'      => ['exists:App\Models\Cuenta,id', 'numeric', 'integer', 'required'],
            'fileAfip'       => ['required', 'mimes:txt', 'max:2048'],
        ];
    }

    protected function validateData()
    {
        // $encabezado = $this->firstRecord();

        // if (! $encabezado)
        //     throw new InvalidFormatException('No hay datos para procesar.');

        // if (\substr($encabezado, 0, 2) !== 'RE')
        //     throw new InvalidFormatException('No se puede procesar el archivo de Reintegros.');
    }

    public function processRecord($record)
    {
        $confirmado  = 1;
        $observacion = '';

        $idTipoComprobante = (int)\substr($record, 8, 3);

        $tipoComprobante = TipoComprobante::findByAfip($idTipoComprobante);

        if (! $tipoComprobante)
        {
            $confirmado = 0;
            $observacion = 'No existe el Tipo de Comprobante';
        }
        else
        {
            $persona = Persona::findByIdFiscal((int)\substr($record, 58, 20));

            if (! $persona)
            {
                $recordPersona = [
                    'nombre'         => \substr($record, 78, 30),
                    'abreviatura'    => '',
                    'tipoDocumento'  => (int)\substr($record, 56, 2),
                    'identificador'  => (int)\substr($record, 58, 20)
                ];

                $persona = Persona::create($recordPersona);
            }


            $existeComprobante = CuentaCorriente::existe($persona->identificador, $idTipoComprobante, \substr($record, 11, 5), \substr($record, 16, 20));

            if ($existeComprobante)
            {
                $confirmado = 0;
                $observacion = 'El Comprobante ya ha sido cargado';
            }
        }

        $this->data[] = [
            'confirmado'                 => $confirmado,
            'observacion'                => $observacion,
            'fecha'                      => \substr($record, 0, 8),
            'fecha_f'                    => MiDate::fromFormatTo('Ymd', \substr($record, 0, 8), 'd/m/Y'),
            'tipoComprobante'            => $idTipoComprobante,
            'descripcionTipo'            => ($tipoComprobante) ? $tipoComprobante->descripcion : '',
            'sucursal'                   => \substr($record, 11, 5), 
            'comprobanteDesde'           => (int)\substr($record, 16, 20),  
            'comprobanteDesde_f'         => Formatter::zeros((int)\substr($record, 16, 20)),
            'comprobanteHasta'           => (int)\substr($record, 36, 20), 
            'codDocumento'               => (int)\substr($record, 56, 2),
            'idComprador'                => (int)\substr($record, 58, 20),
            'nombreComprador'            => ($persona->abreviatura) ? $persona->abreviatura : $persona->nombre,
            'importe'                    => (float)\substr($record, 108, 15) / 100,
            'importe_f'                  => Formatter::money((float)\substr($record, 108, 15) / 100),
            'importeNoGravado'           => (float)\substr($record, 123, 15) / 100,
            'importePercepcion'          => (float)\substr($record, 138, 15) / 100,
            'importeExento'              => (float)\substr($record, 153, 15) / 100,
            'importePercepcionNacional'  => (float)\substr($record, 168, 15) / 100,
            'importePercepcionIB'        => (float)\substr($record, 183, 15) / 100,
            'importePercepcionMunicipal' => (float)\substr($record, 198, 15) / 100,
            'importeImpuestoInterno'     => (float)\substr($record, 213, 15) / 100, 
        ];

        if ($confirmado)
        {
            $this->cantidad += 1;
            $this->importeTotal += (float)\substr($record, 108, 15) / 100;
        }
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [
            'cuenta_id' => $this->cuenta_id
        ];
    }

    public function rules(): array
    {
        return [
            'cuenta_id'    => ['exists:App\Models\Cuenta,id', 'numeric', 'integer', 'required'],
            'comprobante'  => ['array' ],
        ];
    }

    protected function executeSaveOneByOne(&$records)
    {
        \DB::beginTransaction();

        $cantidad = 0;

        try
        {
            foreach ($this->comprobante as $id => $comprobante)
            {
                $persona = Persona::findByIdFiscal($comprobante['idComprador']);
                $tipoComprobante = TipoComprobante::find($comprobante['tipoComprobante']);

                $record= [
                    'cuenta_id'                  => $this->cuenta_id,
                    'fecha'                      => MiDate::fromFormatTo('Ymd', $comprobante['fecha'], 'Y-m-d'),
                    'tipoComprobante_id'         => $comprobante['tipoComprobante'],
                    'puntoVenta'                 => $comprobante['sucursal'],
                    'numeroComprobante'          => $comprobante['comprobante'],
                    'tipoDocumento'              => $comprobante['codDocumento'],
                    'identificadorComprador'     => $comprobante['idComprador'],
                    'persona_id'                 => $persona->id,
                    'importe'                    => $comprobante['importe'],
                    'importePercepcion'          => (isset($comprobante['importePercepcion'])) ? $comprobante['importePercepcion'] : 0,
                    'importeNoGravado'           => (isset($comprobante['importeNoGravado'])) ? $comprobante['importeNoGravado'] : 0,
                    'importeExento'              => (isset($comprobante['importeExento'])) ? $comprobante['importeExento'] : 0,
                    'importePercepcionNacional'  => (isset($comprobante['importePercepcionNacional'])) ? $comprobante['importePercepcionNacional'] : 0,
                    'importePercepcionIB'        => (isset($comprobante['importePercepcionIB'])) ? $comprobante['importePercepcionIB'] : 0,
                    'importePercepcionMunicipal' => (isset($comprobante['importePercepcionMunicipal'])) ? $comprobante['importePercepcionMunicipal'] : 0,
                    'importeImpuestoInterno'     => (isset($comprobante['importeImpuestoInterno'])) ? $comprobante['importeImpuestoInterno'] : 0,
                    'saldo'                      => $comprobante['importe'],
                    'columna'                    => ($tipoComprobante->tipo == 1) ? 'D' : 'H',
                ];

                CuentaCorriente::create($record);
                $cantidad++;
            }

            \DB::commit();

            $this->updatedMessage = "Se han importado {$cantidad} movimientos de facturacion correctamente.";
            return true;
        }
        catch(\Throwable $th)
        {
            \DB::rollback();
            dd($th->getMessage());
        }
    }
}