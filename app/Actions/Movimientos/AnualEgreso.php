<?php

namespace App\Actions\Movimientos;

use Illuminate\Support\Facades\DB;
use App\Lib\Actions\SelectAction;
use App\Models\Categoria;
use App\Models\ResumenAnual;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;
 
class AnualEgreso extends SelectAction
{
    protected $anio;

    function __construct()
    {
        parent::__construct(Categoria::class);
    }

    public function requestKey()
    {
        return 'Movimientos.ResumenAnual.Egresos';
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
              ->whereRaw('(uso = 2 OR uso = 3)');
    }

    protected function createListOptions()
    {
        $this->anio = (isset($this->requestData['periodo'])) 
                        ? $this->requestData['periodo']
                        : MiDate::object('first day of this year')->year;

        return parent::createListOptions();
    }

    protected function createRecord(&$modelData)
    {
        $valores = [
            0  => 0,
            1  => 0,
            2  => 0,
            3  => 0,
            4  => 0,
            5  => 0,
            6  => 0,
            7  => 0,
            8  => 0,
            9  => 0,
            10 => 0,
            11 => 0
        ];
        $total = 0;

        $gastos = ResumenAnual::where('tipo', 2)
                            ->where('categoria_id', $modelData->id)
                            ->whereRaw('anio = ' . $this->anio)
                            ->groupBy('mes')
                            ->selectRaw('SUM(`importe`) as importe, mes')
                            ->get();

        foreach ($gastos as $gasto)
        {
            $total += $gasto->importe;

            $mes = $gasto->mes - 1; 

            $valores[$mes] += $gasto->importe;
        }
                            
        $record = new \stdClass();

        $record->categoria = $modelData->nombre;
        $record->enero     = Formatter::moneyArg($valores[0]);
        $record->febrero   = Formatter::moneyArg($valores[1]);
        $record->marzo     = Formatter::moneyArg($valores[2]);
        $record->abril     = Formatter::moneyArg($valores[3]);
        $record->mayo      = Formatter::moneyArg($valores[4]);
        $record->junio     = Formatter::moneyArg($valores[5]);
        $record->julio     = Formatter::moneyArg($valores[6]);
        $record->agosto    = Formatter::moneyArg($valores[7]);
        $record->setiembre = Formatter::moneyArg($valores[8]);
        $record->octubre   = Formatter::moneyArg($valores[9]);
        $record->noviembre = Formatter::moneyArg($valores[10]);
        $record->diciembre = Formatter::moneyArg($valores[11]);
        $record->total     = Formatter::moneyArg($total);
        
        $record->m1        = Formatter::decimalNumber($valores[0]);
        $record->m2        = Formatter::decimalNumber($valores[1]);
        $record->m3        = Formatter::decimalNumber($valores[2]);
        $record->m4        = Formatter::decimalNumber($valores[3]);
        $record->m5        = Formatter::decimalNumber($valores[4]);
        $record->m6        = Formatter::decimalNumber($valores[5]);
        $record->m7        = Formatter::decimalNumber($valores[6]);
        $record->m8        = Formatter::decimalNumber($valores[7]);
        $record->m9        = Formatter::decimalNumber($valores[8]);
        $record->m10       = Formatter::decimalNumber($valores[9]);
        $record->m11       = Formatter::decimalNumber($valores[10]);
        $record->m12       = Formatter::decimalNumber($valores[11]);
        $record->t         = Formatter::decimalNumber($total);

        return $record;
    }
}