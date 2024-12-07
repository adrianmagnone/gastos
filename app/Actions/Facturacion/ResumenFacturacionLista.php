<?php

namespace App\Actions\Facturacion;

use App\Lib\Actions\SelectAction;
use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

use App\Models\ResumenFacturacion;
use App\Models\CategoriaMonotributo;
 
class ResumenFacturacionLista extends SelectAction
{
    protected $acumulado;

    function __construct()
    {
        $this->viewList = 'resumen_facturacion.index';
        parent::__construct(ResumenFacturacion::class);
    }

    public function requestKey()
    {
        return 'ResumenFacturacion.Consulta';
    }

    protected function runFromRequest()
    {
        $this->acumulado = [];
        parent::runFromRequest();
    }

    protected function setFilterClass()
    {
        return \App\ActionFilters\ResumenFacturacionFiltro::class;
    }

    protected function setFieldSustitute()
    {
        return [
            'fecha' => ['anio', 'mes']
        ];
    }

    protected function aditionalDataForList()
    {
        return [
            'cuentas'      => \App\Models\Cuenta::activas(),
            'fechaInicial' => MiDate::object('first day of previous year')->format('d/m/Y')
        ];
    }

    protected function createRecord(&$modelData)
    {
        $this->acumulado[] = $modelData->importe;

        $acumulado = array_sum(array_slice($this->acumulado, -12));

        $record = new \stdClass();

        $monotributo = CategoriaMonotributo::vigentesAlPeriodo($modelData->periodo);
        
        $catA = ($monotributo) ? $monotributo->where('categoria', 'A')->first() : false;
        $catB = ($monotributo) ? $monotributo->where('categoria', 'B')->first() : false;
        $catC = ($monotributo) ? $monotributo->where('categoria', 'C')->first() : false;
        $catD = ($monotributo) ? $monotributo->where('categoria', 'D')->first() : false;
        $catE = ($monotributo) ? $monotributo->where('categoria', 'E')->first() : false;
        $catF = ($monotributo) ? $monotributo->where('categoria', 'F')->first() : false;
        $catG = ($monotributo) ? $monotributo->where('categoria', 'G')->first() : false;
        $catH = ($monotributo) ? $monotributo->where('categoria', 'H')->first() : false;
        $catI = ($monotributo) ? $monotributo->where('categoria', 'I')->first() : false;
        $catJ = ($monotributo) ? $monotributo->where('categoria', 'J')->first() : false;
        $catK = ($monotributo) ? $monotributo->where('categoria', 'K')->first() : false;

        $record->id     = $modelData->id;

        $record->fecha = $modelData->periodo_format;
        $record->total = $modelData->importe_format;

        $record->dif_a = ($catA) ? $catA->importe_anual - $acumulado : 0; 
        $record->dif_b = ($catB) ? $catB->importe_anual - $acumulado : 0;
        $record->dif_c = ($catC) ? $catC->importe_anual - $acumulado : 0;
        $record->dif_d = ($catD) ? $catD->importe_anual - $acumulado : 0;
        $record->dif_e = ($catE) ? $catE->importe_anual - $acumulado : 0;
        $record->dif_f = ($catF) ? $catF->importe_anual - $acumulado : 0;
        $record->dif_g = ($catG) ? $catG->importe_anual - $acumulado : 0;
        $record->dif_h = ($catH) ? $catH->importe_anual - $acumulado : 0;
        $record->dif_i = ($catI) ? $catI->importe_anual - $acumulado : 0;
        $record->dif_j = ($catJ) ? $catJ->importe_anual - $acumulado : 0;
        $record->dif_k = ($catK) ? $catK->importe_anual - $acumulado : 0;

        $record->a     = ($catA) ? Formatter::moneyArg($catA->importe_anual - $acumulado) : ''; 
        $record->b     = ($catB) ? Formatter::moneyArg($catB->importe_anual - $acumulado) : '';
        $record->c     = ($catC) ? Formatter::moneyArg($catC->importe_anual - $acumulado) : '';
        $record->d     = ($catD) ? Formatter::moneyArg($catD->importe_anual - $acumulado) : '';
        $record->e     = ($catE) ? Formatter::moneyArg($catE->importe_anual - $acumulado) : '';
        $record->f     = ($catF) ? Formatter::moneyArg($catF->importe_anual - $acumulado) : '';
        $record->g     = ($catG) ? Formatter::moneyArg($catG->importe_anual - $acumulado) : '';
        $record->h     = ($catH) ? Formatter::moneyArg($catH->importe_anual - $acumulado) : '';
        $record->i     = ($catI) ? Formatter::moneyArg($catI->importe_anual - $acumulado) : '';
        $record->j     = ($catJ) ? Formatter::moneyArg($catJ->importe_anual - $acumulado) : '';
        $record->k     = ($catK) ? Formatter::moneyArg($catK->importe_anual - $acumulado) : '';

        $record->acumulado = Formatter::moneyArg($acumulado);
        
        return $record;
    }
}