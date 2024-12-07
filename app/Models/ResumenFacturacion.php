<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class ResumenFacturacion extends Model
{
    protected $table = "resumen_facturacion";

    protected $fillable = [
        'anio',
        'mes',
        'periodo',
        'cuenta_id',
        'importe'
    ];

    public function cuenta() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Cuenta::class);
    }

    public function descripcionCuenta(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->cuenta->nombre ?? ''
        );
    }

    public function periodoFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => MiDate::toMonthYearFormat($this->periodo)
        );
    }

    public function importeFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::moneyArg($this->importe)
        );
    }
}
