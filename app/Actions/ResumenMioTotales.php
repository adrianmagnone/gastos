<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;
use App\Lib\Actions\SelectAction;
use App\Models\MovimientoMio;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class ResumenMioTotales extends SelectAction
{


    function __construct()
    {
        parent::__construct(MovimientoMio::class);
    }

    protected function getQuery()
    {
        return $this->model->query()
                    ->selectRaw('MONTH(fecha), YEAR(fecha)')
                    ->selectRaw('sum(CASE WHEN tipo = 1 then `importe` else 0 END) as ingresos')
                    ->selectRaw('sum(CASE WHEN tipo = 1 then `saldo` else 0 END) as saldo_ingresos')
                    ->selectRaw('SUM(CASE WHEN tipo = 2 then `importe` else 0 END) AS egresos')
                    ->selectRaw('sum(CASE WHEN tipo = 2 then `saldo` else 0 END) as saldo_egresos')
                    ->groupByRaw('MONTH(fecha), YEAR(fecha)')
                    ->where('saldo' , '>', 0);
    }

    public function requestKey()
    {
        return 'ResumenMio.TotalesMensual';
    }

    protected function setFieldSustitute()
    {
        return [
            'mes' => ['YEAR(fecha)', 'MONTH(fecha)']
        ];
    }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $fecha = $modelData->{"YEAR(fecha)"} . '-' . $modelData->{"MONTH(fecha)"} . '-01';

        $record->id = $modelData->id;
        $record->mes = MiDate::toMonthYearFormat($fecha); 
        $record->ingresos_f = Formatter::moneyArg($modelData->ingresos);
        $record->egresos_f  = Formatter::moneyArg($modelData->egresos);
        $record->ingresos   = $modelData->ingresos;
        $record->egresos    = $modelData->egresos;
        $record->saldo_ingresos = $modelData->saldo_ingresos;
        $record->saldo_egresos  = $modelData->saldo_egresos;
        
        return $record;
    }
}