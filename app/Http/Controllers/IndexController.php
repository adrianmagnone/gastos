<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class IndexController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'serieGastos' => json_encode($this->getData()),
            'widTareas'   => $this->getTareas()
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

    protected function getData()
    {
        $data = [];

        $fila1 = new \stdClass();
        $fila1->name = '';
        $fila1->data = [155, 65, 465, 265, 225, 325, 80];

        $fila2 = new \stdClass();
        $fila2->name = '';
        $fila2->data = [113, 42, 65, 54, 76, 65, 35];

        $data[] = $fila1;
        $data[] = $fila2;

        return $data;
    }
}