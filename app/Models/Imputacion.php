<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Helpers\Formatter;

class Imputacion extends Model
{
    protected $table = "imputaciones";

    protected $fillable = [
        'comprobante_debe',
        'comprobante_haber',
        'importe'
    ];

    public function comprobanteDebe() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CuentaCorriente::class, 'comprobante_debe');
    }

    public function comprobanteHaber() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CuentaCorriente::class, 'comprobante_haber');
    }

    public function importeFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::money($this->importe)
        );
    }

    public static function deDebe($id)
    {
        return Imputacion::where('comprobante_debe', $id)->get();
    }

    public static function deHaber($id)
    {
        return Imputacion::where('comprobante_haber', $id)->get();
    }
}
