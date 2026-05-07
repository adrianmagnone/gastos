<?php

namespace App\Actions\Categorias;

use Aiglos\Lba\Excel\ExcelBase;
use App\Models\Categoria;

class CategoriaExcel extends CategoriaLista
{
    use \Aiglos\Lba\Traits\GenerateTitles;

    protected function createFile()
    {
        $excel =  new ExcelBase("Listado de Categorias", $this->exportTittle);

        $excel->setFileName('ListadoCategorias');

        $excel->setHeaders([
            'id'  => ['titulo'=> '#',                            ],
            'nom' => ['titulo'=> 'Nombre',         'ancho'=>25   ],
            'uso' => ['titulo'=> 'Uso',            'ancho'=>15   ],
            'est' => ['titulo'=> 'Estado',         'ancho'=>15   ]
        ]);

        $excel->setData($this->queryData);

        $excel->run(function($modelData) {

            return [
                'id'  => $modelData->id,
                'nom' => $modelData->nombre,
                'uso' => Categoria::USOS[$modelData->uso],
                'est' => Categoria::ESTADOS[$modelData->estado]
            ];

        });

        $excel->output();
    }

    protected function createTitles()
    {
        $this->ordenTittleSustitute = [
            'id'             => 'Código',
            'nombre'         => 'Nombre de Categoria',
        ];

        $this->filterTittleSustitute = [];
    }
}