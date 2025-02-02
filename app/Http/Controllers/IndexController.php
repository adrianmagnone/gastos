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
        $fila1->data = [2233713.92, 2240387.91, 1791078.01, 2326091.80, 1732821.63, 4273135.28, 5475971.65, 5142265.04, 4536801.39, 4918385.29, 4868966.53, 5002122.72  ];

        $fila2 = new \stdClass();
        $fila2->name = 'Gastos';
        $fila2->data = [2247263.05, 2450132.33, 1756995.84, 2220621.88, 2098345.04, 2777270.83, 3397723.17, 5247359.80, 3836395.84, 5601596.69, 7018723.69, 5170112.87  ];

        $data[] = $fila1;
        $data[] = $fila2;

        return $data;
    }
}