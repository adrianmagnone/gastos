<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;
use App\Lib\Actions\SelectAction;
use App\Models\MovimientoFondo;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class ResumenFondoTotales extends SelectAction
{
    protected $saldo = 0;
    protected $puedoGastar = 0;
    protected $ingresoVirtual = 0;

    function __construct()
    {
        parent::__construct(MovimientoFondo::class);
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

    protected function setFilterClass()
    {
        return \App\ActionFilters\MovimientoFondoFiltro::class;
    }

    public function requestKey()
    {
        return 'ResumenFondo.TotalesMensual';
    }

    protected function setFieldSustitute()
    {
        return [
            'mes' => ['YEAR(fecha)', 'MONTH(fecha)']
        ];
    }

    protected function createRecord(&$modelData)
    {
        $this->ingresoVirtual = (float)$this->myFilter->get('ingreso');

        $record = new \stdClass();

        $fecha  = $modelData->{"YEAR(fecha)"} . '-' . $modelData->{"MONTH(fecha)"} . '-01';
        $finMes = date("Y-m-t", strtotime($fecha));

        $periodoFuturo = (MiDate::greatToday($finMes)) ? 1 : 0; 
        $this->saldo   = $this->saldo + ($modelData->saldo_ingresos - $modelData->saldo_egresos);

        $record->id              = $modelData->id;
        $record->mes             = MiDate::toMonthYearFormat($fecha); 
        $record->ingresos_f      = Formatter::moneyArg($modelData->saldo_ingresos);
        $record->egresos_f       = Formatter::moneyArg($modelData->saldo_egresos);
        $record->ingresos        = (float)$modelData->ingresos;
        $record->egresos         = (float)$modelData->egresos;
        $record->saldo_ingresos  = (float)$modelData->saldo_ingresos;
        $record->saldo_egresos   = (float)$modelData->saldo_egresos;
        $record->saldo           = Formatter::moneyArg($this->saldo);
        $record->posible_f       = Formatter::moneyArg(0);
        $record->puedoGastar_f   = Formatter::moneyArg($this->puedoGastar + $this->saldo);

        if ($periodoFuturo && $this->ingresoVirtual)
        {
            $ingresoPosible = $this->ingresoVirtual - $record->ingresos;
            if ($ingresoPosible > 0)
            {
                $record->posible_f      = Formatter::moneyArg($ingresoPosible);
                $this->puedoGastar      = $this->puedoGastar + ($modelData->saldo_ingresos + $ingresoPosible);
            }
        }
        return $record;
    }
}