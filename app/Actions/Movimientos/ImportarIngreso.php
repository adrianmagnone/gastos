<?php

namespace App\Actions\Movimientos;

use Aiglos\Lba\Actions\ImportFileAction;
use Illuminate\Support\Facades\Storage;
use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

use App\Models\Movimiento;

class ImportarIngreso extends ImportFileAction
{
    use \Aiglos\Lba\Import\ReadCsvBase;

    function __construct()
    {
        $this->model = Movimiento::class;

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
                2 => 'Banco Hipotecario',
                3 => 'Banco Hipotecario - 2026', 
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
            return Storage::disk('local')->putFile('importar', $this->request->file('fileIngresos'));
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
            $this->data[] = $registro;
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [
            'data' => $this->data,
            'formasPagos' => Movimiento::TIPOS_PAGOS,
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
            'tipoPago'     => ['required', 'numeric', 'integer', 'in:1,2,3,4,5,6,7,99'],
            // 'importe.*'    => ['required', 'numeric', 'decimal:2'],
        ];
    }

    public function getRecords() : array
    {
        $records = [];

        foreach($this->check as $index => $check)
        {
            $records[] = [
                'fecha'        => MiDate::fromFormatTo('d/m/Y', $this->fecha[$index], 'Y-m-d'),
                'tipo'         => Movimiento::TipoFrom('Ingreso'),
                'categoria_id' => (int)$this->categoria_id,
                'descripcion'  => ($this->observacion[$index])
                                        ? $this->descripcion[$index] . ' - ' . $this->observacion[$index]
                                        : $this->descripcion[$index],
                'importe'      => (float)$this->importe[$index],
                'tipoPago'     => (int)$this->tipoPago,
            ];
        }

        return $records;
    }
}