<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class IndexController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'serieGastos'    => json_encode($this->getData()),
            'widTareas'      => $this->getTareas(),
            'widLiquidacion' => $this->getLiquidacion()
        ]);
    }

    protected function getTareas()
    {
        $count = \App\Models\Tarea::where('estado', 3)->count();

        $titulo = match ($count) {
             0 => 'No tiene tarea pendientes',
             1 => '1 Tarea Pendiente',
             default => "{$count} Tareas Pendientes"
        };

        $proyectos = \App\Models\Tarea::select('proyecto')->where('estado', 3)->groupBy('proyecto')->get();

        $count = $proyectos->count();

        $subtitulo = match ($count) {
            0 => '',
            1 => '1 Proyecto',
            default => "{$count} Proyectos"
       };

        return [
            'titulo' => $titulo,
            'subtitulo' => $subtitulo
        ];
    }

    protected function getLiquidacion()
    {
        return \App\Models\PagoTarjeta::where('pasadoGasto', 0)->first();
    }

    protected function getData()
    {
        $data = [];

        $fila1 = new \stdClass();
        $fila1->name = 'Ingresos';
        $fila1->data = [1241563.75,1090075.48,1101361.87,1037402.55,1374872.15,1494979.83,1821176.70, 2002276.06, 2233713.92, 2240387.91, 1791078.01, 2326091.80];

        $fila2 = new \stdClass();
        $fila2->name = 'Gastos';
        $fila2->data = [945520.27, 1068282.81,820722.81,1086492.87,1042813.86,1089855.26,1985847.17, 1807761.70, 2247263.05, 2450132.33, 1756995.84, 2220621.88];

        $data[] = $fila1;
        $data[] = $fila2;

        return $data;
    }
}