<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class TotalMensualGasto extends Model
{
    protected $table = "totales_mensuales_gastos";

    public static function getLast()
    {
        $originalData = TotalMensualGasto::orderBy('periodo', 'desc')->take(12)->get();
        
        return $originalData->sortBy('periodo');
    }

    public static function formatImporteGastos($data)
    {
        $records = [];

        $fila1 = new \stdClass();
        $fila1->name = 'Ingresos';
        $fila1->data = $data->map(function ($item) {
            return (float)$item->total_ingresos;
        })->values()->toArray();

        $fila2 = new \stdClass();
        $fila2->name = 'Gastos';
        $fila2->data = $data->map(function ($item) {
            return (float)$item->total_egresos;
        })->values()->toArray();

        $records[] = $fila1;
        $records[] = $fila2;

        return $records;
    }

    public static function formatLabelGastos($data)
    {
        return $data->map(function ($item) {
            return \ucfirst(MiDate::toFormat($item->periodo, 'M y'));
        })->values()->toArray();
    }

    public static function formatImporteDiferencia($data)
    {
        return $data->map(function ($item) {
            return \round($item->total_ingresos - $item->total_egresos, 2);
        })->values()->toArray();
    }

    public static function formatLabelDiferencia($data)
    {
        return $data->map(function ($item) {
            return $item->periodo;
        })->values()->toArray();
    }

    
}
