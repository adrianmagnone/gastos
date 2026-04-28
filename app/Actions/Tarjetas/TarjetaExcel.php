<?php

namespace App\Actions\Tarjetas;

use Aiglos\Lba\Excel\ExcelBase;

class TarjetaExcel extends TarjetaLista
{
    use \Aiglos\Lba\Traits\GenerateTitles;

    protected function createFile()
    {
        $excel =  new ExcelBase("Listado de Tarjetas", $this->exportTittle);

        $excel->setFileName('ListadoTarjetas');

        $excel->setHeaders([
            'id'  => ['titulo'=> '#',                            ],
            'nom' => ['titulo'=> 'Nombre',         'ancho'=>25   ],
            'est' => ['titulo'=> 'Estado',         'ancho'=>15   ]
        ]);

        $excel->setData($this->queryData);

        $excel->run(function($modelData) {

            return [
                'id'  => $modelData->id,
                'nom' => $modelData->nombre,
                'est' => ($modelData->estado == 1) ? 'Activa' : 'Baja',
            ];

        });

        $excel->output();
    }

    protected function createTitles()
    {
        $this->ordenTittleSustitute = [
            'id'             => 'Código',
            'nombre'         => 'Nombre de Tarjeta',
        ];

        $this->filterTittleSustitute = [];
    }
}