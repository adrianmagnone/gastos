<?php

namespace App\Actions\Tickets;

use Illuminate\Validation\Rules\Enum;

use App\Helpers\DateHelper as MiDate;
use Aiglos\Lba\Actions\EditAction;
use App\Enums\PagosMovimiento;
use App\Enums\TiposMovimiento;
use App\Models\Ticket;
use App\Models\Movimiento;

class TicketEditar extends EditAction
{
    function __construct()
    {
        $this->model = Ticket::class;

        $this->urlList     = route('movimientos');
        $this->urlSave     = route('ticket.guardar');
        //$this->urlDelete   = route('movimiento.borrar');
        $this->urlBackEdit = 'ticket/nuevo';

        $this->editView    = 'tickets.edit';
        $this->deleteView  = 'tickets.edit';

        $this->updatedMessage = 'El Ticket se ha agregado correctamente!';
        $this->deletedMessage = 'El Ticket se ha borrado correctamente!';
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        $movimientos = [];

        if ($entidad)
        {
            foreach($entidad->detalle as $detalle)
            {
                $movimientos[] = [
                    'id'          => $detalle->id,
                    'categoria'   => $detalle->categoria_id,
                    'importe'     => $detalle->importeEdit,
                    'observacion' => $detalle->descripcion
                ];
            }
        }

        return [
            'tipos'       => TiposMovimiento::toArray(),
            'categorias'  => \App\Models\Categoria::all(),
            'tiposPagos'  => PagosMovimiento::toIconArray(),
            'movimientos' => $movimientos
        ];
    }

    protected function _createModel()
    {
        $model = new $this->model;
        $model->tipo = TiposMovimiento::GASTO;
        $model->tipoPago = PagosMovimiento::TARJETA_DEBITO;
        return $model;
    }

    protected function prepareForValidation()
    {
        return [
            'importe' => $this->toDecimal('importe')
        ];
    }

    public function rules(): array
    {
        return [
            'fecha'        => ['required', 'date_format:d/m/Y'],
            'tipo'         => ['required', 'in:1,2'],
            'descripcion'  => ['string', 'required' ],
            'importe'      => ['numeric', 'decimal:2', 'required'],
            'tipoPago'     => ['required', new Enum(PagosMovimiento::class)],
            'movimientos'  => ['required', 'array', 'min:1'],
            'movimientos.*.categoria'   => ['numeric', 'integer', 'required', 'exists:categorias,id'],
            'movimientos.*.importe'     => ['required'],
            'movimientos.*.observacion' => ['string', 'nullable' ]
        ];
    }

	public function getRecord() : array
	{
        return  [
            'fecha'        => MiDate::fromFormatTo('d/m/Y', $this->fecha, 'Y-m-d'),
            'tipo'         => $this->tipo,
            'descripcion'  => $this->descripcion,
            'importe'      => $this->importe,
            'tipoPago'     => $this->request->enum('tipoPago', PagosMovimiento::class)
        ];
	}

    protected function completeUpdate(&$entidad, &$request)
    {
        foreach ($this->movimientos as $indice => $movimiento)
        {
            if (isset($movimiento['id']))
            {
                $detalle = Movimiento::find($id);

                $detalle->fill($movimiento);
                $detalle->save();
            }
            else
            {
                $detalle = [
                    'fecha'        => $entidad->fecha,
                    'tipo'         => $entidad->tipo,
                    'ticket_id'    => $entidad->id,
                    'categoria_id' => $movimiento['categoria'],
                    'descripcion'  => $movimiento['observacion'],
                    'importe'      => $this->valueToDecimal($movimiento['importe']),
                    'tipoPago'     => $entidad->tipoPago
                ];

                Movimiento::create($detalle);
            }
        } 
    }

}