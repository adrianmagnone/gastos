<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class DetallePagoTarjeta extends Model
{
    protected $table = "detalle_pagos_tarjetas";

    protected $fillable = [
        'pago_id',
        'compra_id',
        'importe'
    ];

    public function compra() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraTarjeta::class, 'compra_id');
    }

    public function importeFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::moneyArg($this->importe)
        );
    }

    public function compraDescripcion(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->compra->descripcion ?? ''
        );
    }

    public function compraCategoria(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->compra->descripcion_categoria ?? ''
        );
    }
}