<?php

namespace App\Actions\Movimientos;

use Aiglos\Lba\Actions\ImportFileAction;
use Illuminate\Support\Facades\Storage;
use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

use App\Models\Movimiento;

class ImportarEgreso extends ImportFileAction
{
    use \Aiglos\Lba\Import\ReadCsvBase;

    function __construct()
    {
        $this->model = Movimiento::class;

        $this->urlList   = route('movimientos');
        $this->urlImport = 'movimientos/lee_egresos';
        $this->urlSave   = 'movimientos/guarda_egresos';

        $this->loadView  = 'movimientos.import_egr';
        $this->editView  = 'movimientos.import_egr2';

        $this->skipRows  = 1;

        $this->updatedMessage = 'Los Egresos se han importado correctamente.';
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
            'fileEgresos' => ['required', 'mimes:csv', 'max:2048'],
        ];
    }

    protected function loadFile()
    {
        if ($this->request->hasFile('fileEgresos'))
        {
            return Storage::disk('local')->putFile('importar', $this->request->file('fileEgresos'));
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

        if ($registro['tipo'] === 'Gasto')
            $this->data[] = $registro;
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [
            'data'        => $this->data,
            'formasPagos' => Movimiento::TIPOS_PAGOS,
            'categorias'  => \App\Models\Categoria::paraEgresosPorNombre(),
        ];
    }

    public function rules() : array
    {
        return [
            'check'        => ['required', 'array', 'min:1'],
            'fecha'        => ['required', 'array', 'min:1'],
            'observacion'  => ['array'], 
            'importe'      => ['required', 'array', 'min:1'],
            'formaPago'    => ['required', 'array', 'min:1'],
            'categoria'    => ['required', 'array', 'min:1'],
            
        ];
    }

    public function getRecords() : array
    {
        $records = [];

        foreach($this->check as $index => $check)
        {
            $records[] = [
                'fecha'        => MiDate::fromFormatTo('d/m/Y', $this->fecha[$index], 'Y-m-d'),
                'tipo'         => Movimiento::TipoFrom('Gasto'),
                'categoria_id' => (int)$this->categoria[$index],
                'descripcion'  => ($this->observacion[$index])
                                        ? $this->observacion[$index]
                                        : null,
                'importe'      => (float)$this->importe[$index],
                'tipoPago'     => (int)$this->formaPago[$index],
            ];
        }

        return $records;
    }
}