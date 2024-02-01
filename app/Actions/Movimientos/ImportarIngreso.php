<?php

namespace App\Actions\Movimientos;

use App\Lib\Actions\ImportFileAction;
use Illuminate\Support\Facades\Storage;
use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

use App\Models\Movimiento;

class ImportarIngreso extends ImportFileAction
{
    use \App\Lib\Csv\ReadCsvBase;

    function __construct()
    {
        $this->model = Movimiento::class;
        $this->reader = \App\Lib\Excel\ReadCsvBase::class;

        $this->urlList   = route('movimientos');
        $this->urlImport = 'movimientos/lee_ingresos';
        $this->urlSave   = 'movimientos/guarda_ingresos';

        $this->loadView  = 'movimientos.import';
        $this->editView  = 'movimientos.import2';

        $this->skipRows  = 1;

        $this->updatedMessage = 'Los Ingresos se han importado correctamente.';
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
            return Storage::disk('local')->putFile('importar', $this->request->file('fileIngresos'));
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

        if ($importe > 0)
        {
            $this->data[] = [
                'importe'         => $importe,
                'importeFormat'   => Formatter::moneyArg($importe),
                'fecha'           => $record[0],
                'descripcion'     => $record[2],
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

        if ($importe > 0)
        {
            $this->data[] = [
                'importe'         => $importe,
                'importeFormat'   => Formatter::moneyArg($importe),
                'fecha'           => $record[1],
                'descripcion'     => $record[3],
            ];
        }
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [
            'data' => $this->data
        ];
    }

    public function rules() : array
    {
        return [
            'categoria_id' => ['numeric', 'integer', 'required', 'exists:categorias,id'],
            'check'        => ['required', 'array', 'min:1'],
            'fecha'        => ['required', 'array', 'min:1'],
            // 'fecha.*'      => ['required', 'date_format:d/m/Y'],
            'descripcion'  => ['array'],
            'importe'      => ['required', 'array', 'min:1'],
            // 'importe.*'    => ['required', 'numeric', 'decimal:2'],
        ];
    }

    public function getRecords()
    {
        $records = [];

        foreach($this->check as $index => $check)
        {
            $records[] = [
                'fecha'        => MiDate::fromFormatTo('d/m/Y', $this->fecha[$index], 'Y-m-d'),
                'tipo'         => Movimiento::Tipo('Ingreso'),
                'categoria_id' => (int)$this->categoria_id,
                'descripcion'  => ($this->observacion[$index])
                                        ? $this->descripcion[$index] . ' - ' . $this->observacion[$index]
                                        : $this->descripcion[$index],
                'importe'      => (float)$this->importe[$index],    
            ];
        }

        return $records;
    }
}