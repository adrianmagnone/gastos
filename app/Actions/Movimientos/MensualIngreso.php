<?php

namespace App\Actions\Movimientos;

use Illuminate\Support\Facades\DB;
use App\Lib\Actions\SelectAction;
use App\Models\Categoria;
use App\Models\Movimiento;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;
 
class MensualIngreso extends SelectAction
{
    protected $fechaPeriodo;
    protected $semanaPeriodo;

    function __construct()
    {
        parent::__construct(Categoria::class);
    }

    public function requestKey()
    {
        return 'Movimientos.ResumenMensual.Ingresos';
    }
    
    protected function setFieldSustitute()
    {
        return [
            'categoria' => 'id'
        ];
    }

    protected function setSelectionFilter(&$query)
    {
        $query->where('estado', 1)
              ->whereRaw('(uso = 1 OR uso = 3)');
    }

    protected function createListOptions()
    {
        $parametro = MiDate::fromFormatTo('d/m/Y', $this->requestData['periodo'], 'Y-m-d');
        
        $this->fechaPeriodo = ($parametro) ? MiDate::object($parametro) : MiDate::object('first day of this month');
        $this->semanaPeriodo = $this->fechaPeriodo->week - 1;

        return parent::createListOptions();
    }

    protected function createRecord(&$modelData)
    {
        $valores = [
            0 => 0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
        ];
        $total = 0;

        $gastos = Movimiento::where('tipo', 1)
                            ->where('categoria_id', $modelData->id)
                            ->whereRaw('MONTH(fecha) = ' . $this->fechaPeriodo->month)
                            ->whereRaw('YEAR(fecha) = ' . $this->fechaPeriodo->year)
                            ->groupBy(DB::raw('WEEK(fecha)'))
                            ->selectRaw('SUM(`movimientos`.`importe`) as importe, WEEK(`movimientos`.`fecha`) as semana')
                            ->get();

        foreach ($gastos as $gasto)
        {
            $total += $gasto->importe;

            $semana = $gasto->semana - $this->semanaPeriodo; 

            $valores[$semana] += $gasto->importe;
        }
                            
        $record = new \stdClass();

        $record->categoria = $modelData->nombre;
        $record->semana1   = Formatter::moneyArg($valores[0]);
        $record->semana2   = Formatter::moneyArg($valores[1]);
        $record->semana3   = Formatter::moneyArg($valores[2]);
        $record->semana4   = Formatter::moneyArg($valores[3]);
        $record->semana5   = Formatter::moneyArg($valores[4]);
        $record->semana6   = Formatter::moneyArg($valores[5]);
        $record->total     = Formatter::moneyArg($total);
        
        $record->s1        = Formatter::decimalNumber($valores[0]);
        $record->s2        = Formatter::decimalNumber($valores[1]);
        $record->s3        = Formatter::decimalNumber($valores[2]);
        $record->s4        = Formatter::decimalNumber($valores[3]);
        $record->s5        = Formatter::decimalNumber($valores[4]);
        $record->s6        = Formatter::decimalNumber($valores[5]);
        $record->t         = Formatter::decimalNumber($total);

        return $record;
    }
}