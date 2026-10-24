<?php

namespace App\Actions\Tickets;

use Aiglos\Lba\Actions\SelectAction;
use App\Models\Ticket;

use App\Helpers\DateHelper as MiDate;
 
class TicketLista extends SelectAction
{
    function __construct()
    {
        $this->viewList = 'tickets.index';
        parent::__construct(Ticket::class);
    }

    public function requestKey()
    {
        return 'Ticket.Consulta';
    }

    // protected function setFilterClass()
    // {
    //     return \App\ActionFilters\TicketFiltro::class;
    // }

    protected function setSearchFields()
    {
        return ['descripcion'];
    }

    protected function aditionalDataForList()
    {
        return [
            'listaTipos'      => \App\Enums\TiposMovimiento::toArray(),
            'fechaInicial'    => MiDate::object('first day of this month')->format('d/m/Y'),
            'columns'         => 'Fecha|Importe|Tipo|Pago|Descripción',
            'columnsData'     => 'fecha|importe~f|tipo|tipoPago|descripcion~f|edit~f|delete~f'
        ];
    }

    protected function createRecord(&$modelData)
    {
        $record = new \stdClass();

        $record->id          = $modelData->id;
        $record->fecha       = $modelData->fecha_format;
        $record->descripcion = $modelData->descripcion;
        $record->importe     = $modelData->importe_format;
        $record->tipo        = $modelData->tipo;
        $record->tipoPago    = $modelData->descripcion_tipo_pago;
        
        return $record;
    }
}