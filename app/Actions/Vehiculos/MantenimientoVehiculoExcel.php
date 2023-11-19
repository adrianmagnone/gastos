<?php

namespace App\Actions\Vehiculos;

use App\Lib\Excel\ExcelBase;
use App\Helpers\Formatter;

class MantenimientoVehiculoExcel extends MantenimientoVehiculoLista
{
    use \App\Lib\Actions\GenerateTitles;

    protected function createFile()
    {
        $excel =  new ExcelBase("Mantenimiento Vehiculo", $this->exportTittle);

        $excel->setFileName('MantenimientoVehiculo0');

        $excel->setHeaders([
            'fec' => ['titulo'=>'Fecha',       'ancho'=> 12], 
            'km'  => ['titulo'=>'Km'    ],
            'imp' => ['titulo'=>'Importe',     'ancho'=> 15,   'format' => 'money', 'sum' => true ],
            'obs' => ['titulo'=>'Observación', 'ancho'=> 100 ]
        ]);

        $excel->setData($this->queryData);

        $excel->run(function($modelData) {

            return [
                'fec' => $modelData->fecha_format,
                'km'  => $modelData->km,
                'imp' => Formatter::decimalNumber($modelData->importe),
                'obs' => $modelData->descripcion,
            ];

        });

        $excel->output();
    }

    protected function createTitles()
    {
        $this->ordenTittleSustitute = [
            'id'       => 'Código',
            'fecha   ' => 'Fecha',
        ];

        $this->filterTittleSustitute = [
            'fecha'    =>  function($value) {
                dd($value);
            },
            'vehiculo' =>  function($value) {
                $vehiculo = \App\Models\Vehiculo::find($value);

                return ($vehiculo) 
                            ? "Vehículo: {$vehiculo->descripcion_completa}"
                            : '';
            } 
        ];
    }
}