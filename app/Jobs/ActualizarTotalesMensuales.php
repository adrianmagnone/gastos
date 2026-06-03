<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Models\Movimiento;
use App\Models\TotalMensualGasto;

class ActualizarTotalesMensuales implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $periodos = [
            0 => now()->startOfMonth()->subMonths(2),
            1 => now()->startOfMonth()->subMonths(1),
            2 => now()->startOfMonth(),
        ];

        foreach ($periodos as $periodo)
        {
            $totalIngresos = Movimiento::whereRaw('MONTH(fecha) = ' . $periodo->month)
                                ->whereRaw('YEAR(fecha) = ' . $periodo->year)
                                ->where('tipo', 1)
                                ->sum('importe');

            $totalEgresos = Movimiento::whereRaw('MONTH(fecha) = ' . $periodo->month)
                                ->whereRaw('YEAR(fecha) = ' . $periodo->year)
                                ->where('tipo', 2)
                                ->sum('importe');

            $totalMensual = TotalMensualGasto::where('periodo', $periodo->format('Y-m-01'))->first();

            if ($totalMensual)
            {
                $totalMensual->total_ingresos = $totalIngresos;
                $totalMensual->total_egresos = $totalEgresos;
                $totalMensual->save();
            }
            else
            {
                TotalMensualGasto::create([
                    'periodo'        => $periodo->format('Y-m-01'),
                    'total_ingresos' => $totalIngresos,
                    'total_egresos'  => $totalEgresos
                ]);
            }
            
        }
    }
}
