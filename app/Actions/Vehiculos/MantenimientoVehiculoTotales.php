<?php

namespace App\Actions\Vehiculos;

use Illuminate\Support\Facades\DB;
use App\Lib\Actions\SelectAction;
use App\Models\MantenimientoVehiculo;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class MantenimientoVehiculoTotales extends SelectAction
{
    protected $saldo = 0;

    function __construct()
    {
        parent::__construct(MantenimientoVehiculo::class);
    }

    protected function getQuery()
    {
        return $this->model->query()
                    ->selectRaw('YEAR(fecha)')
                    ->selectRaw('sum(`importe`) as importe')
                    ->groupByRaw('YEAR(fecha)');
    }

    public function requestKey()
    {
        return 'MantenimientoVehiculo.TotalesAnuales';
    }

    protected function setFieldSustitute()
    {
        return [
            'anio' => ['YEAR(fecha)']
        ];
    }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->anio    = $modelData->{"YEAR(fecha)"}; 
        $record->importe = Formatter::moneyArg($modelData->importe);

        return $record;
    }
}