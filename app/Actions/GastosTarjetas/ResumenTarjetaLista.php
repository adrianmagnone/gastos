<?php

namespace App\Actions\GastosTarjetas;

use App\Lib\Actions\SelectAction;
use App\Models\CompraTarjeta;
use App\Models\PagoTarjeta;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;
 
class ResumenTarjetaLista extends SelectAction
{
    protected $ultimoPago;

    function __construct()
    {
        $this->viewList = 'gastos_tarjetas.resumen';
        parent::__construct(CompraTarjeta::class);
    }

    public function requestKey()
    {
        return 'ResumenTarjetas.Consulta';
    }

    protected function setFilterClass()
    {
        return \App\ActionFilters\GastoTarjetaFiltro::class;
    }

    protected function setFieldSustitute()
    {
        return [
            'a' => 'cuotasPendientes'
        ];
    }

    protected function getQuery()
    {
        return $this->model
            ->where('cuotasPendientes', '>', 0);
    }

    protected function aditionalDataForList()
    {
        $titulos = [
            'Fecha',
            'Descripción',
            'Total'
        ];
        $this->ultimoPago = PagoTarjeta::ultimo();
        $periodo = $this->ultimoPago->periodoPago;

        for ($i=0; $i < 12; $i++)
        { 
            $periodo = MiDate::addMonths(1, $periodo);

            $titulos[] = MiDate::toFormat($periodo, 'm/Y');
        }

        return [
            'titulos'       => implode('|', $titulos),
            'listaTarjetas' => \App\Models\Tarjeta::all()
        ];
    }

    protected function createRecord(&$modelData)
    {
        $cuotas = [];
        $this->ultimoPago = PagoTarjeta::ultimo();
        $periodo = $this->ultimoPago->periodoPago;
        $inicio  = MiDate::object($modelData->periodoInicial);
        $numeroCuota  = 0;

        for ($i = 0; $i < 12; $i++)
        { 
            $periodo = MiDate::addMonths(1, $periodo);
            $fechaPeriodo = MiDate::object($periodo);

            if ($inicio > $fechaPeriodo)
                $cuotas[$i] = 0;
            else
            {
                if ($numeroCuota < $modelData->cuotasPendientes)
                {
                    $cuotas[$i] = $modelData->importeCuota;    
                    $numeroCuota++;
                }
                else
                    $cuotas[$i] = 0;
            }
        }
        
        $record = new \stdClass();

        $record->id       = $modelData->id;
        $record->fecha    = $modelData->fecha_format;
        $record->descripcion = $modelData->descripcion;
        $record->total    = $modelData->total_format;
        $record->importe_cuota = $modelData->importe_cuota_format;
        $record->a = ($cuotas[0] > 0)  ? Formatter::moneyArg($cuotas[0]) : '';
        $record->b = ($cuotas[1] > 0)  ? Formatter::moneyArg($cuotas[1]) : '';
        $record->c = ($cuotas[2] > 0)  ? Formatter::moneyArg($cuotas[2]) : '';
        $record->d = ($cuotas[3] > 0)  ? Formatter::moneyArg($cuotas[3]) : '';
        $record->e = ($cuotas[4] > 0)  ? Formatter::moneyArg($cuotas[4]) : '';
        $record->f = ($cuotas[5] > 0)  ? Formatter::moneyArg($cuotas[5]) : '';
        $record->g = ($cuotas[6] > 0)  ? Formatter::moneyArg($cuotas[6]) : '';
        $record->h = ($cuotas[7] > 0)  ? Formatter::moneyArg($cuotas[7]) : '';
        $record->i = ($cuotas[8] > 0)  ? Formatter::moneyArg($cuotas[8]) : '';
        $record->j = ($cuotas[9] > 0)  ? Formatter::moneyArg($cuotas[9]) : '';
        $record->k = ($cuotas[10] > 0) ? Formatter::moneyArg($cuotas[10]) : '';
        $record->l = ($cuotas[11] > 0) ? Formatter::moneyArg($cuotas[11]) : '';

        $record->n_a = $cuotas[0];
        $record->n_b = $cuotas[1];
        $record->n_c = $cuotas[2];
        $record->n_d = $cuotas[3];
        $record->n_e = $cuotas[4];
        $record->n_f = $cuotas[5];
        $record->n_g = $cuotas[6];
        $record->n_h = $cuotas[7];
        $record->n_i = $cuotas[8];
        $record->n_j = $cuotas[9];
        $record->n_k = $cuotas[10];
        $record->n_l = $cuotas[11];
        $record->n_t = $modelData->total;
        
        return $record;
    }
}