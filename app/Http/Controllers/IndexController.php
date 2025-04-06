<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\TotalMensualGasto;


class IndexController extends Controller
{
    public function index()
    {
        $data = TotalMensualGasto::getLast();

        return view('welcome', [
            'serieGastos'      => \json_encode(TotalMensualGasto::formatImporteGastos($data)),
            'labelGastos'      => \json_encode(TotalMensualGasto::formatLabelGastos($data)),
            'serieDiferencias' => \json_encode(TotalMensualGasto::formatImporteDiferencia($data)),
            'labelDiferencias' => \json_encode(TotalMensualGasto::formatLabelDiferencia($data)),
            'widTareas'        => $this->getTareas(),
            'widLiquidacion'   => $this->getLiquidacion()
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
}