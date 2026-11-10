<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Enums\TiposMovimiento;
use App\Enums\PagosMovimiento;
use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class Ticket extends Model
{
    protected $table = "tickets";

    protected $fillable = [
        'fecha',
        'tipo',
        'tipoPago',
        'descripcion',
        'importe',
    ];

    /**
    * Get the attributes that should be cast.
    *
    * @return array<string, string>
    */
    protected function casts(): array
    {
        return [
            'tipo' => TiposMovimiento::class,
            'tipoPago' => PagosMovimiento::class
        ];
    }

    public function detalle(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Movimiento::class, 'ticket_id', 'id');
    }

    public function fechaFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => MiDate::toFormat($this->fecha, 'd/m/Y')
        );
    }

    public function importeFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::moneyArg($this->importe)
        );
    }

    public function importeEdit(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::decimalNumber($this->importe)
        );
    }

    public function descripcionTipo(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tipo->label()
        );
    }

    public function descripcionTipoPago(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tipoPago->label()
        );
    }

    public function esIngreso(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tipo == TiposMovimiento::INGRESO
        );
    }

    public function esGasto(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tipo == TiposMovimiento::GASTO
        );
    }

    public static function gastoDesdeImporte($importe, $fecha)
    {
        $fecha = MiDate::fromFormatTo('d/m/Y', $fecha, 'Y-m-d'); 
        
        return Ticket::where('tipo', TiposMovimiento::GASTO)
                        ->where('importe', $importe)
                        ->whereRaw("fecha BETWEEN DATE_SUB('{$fecha}', INTERVAL 3 DAY) AND '{$fecha}'")
                        ->get();
    }
}
