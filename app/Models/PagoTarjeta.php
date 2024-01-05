<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class PagoTarjeta extends Model
{
    protected $table = "pagos_tarjetas";

    protected $fillable = [
        'tarjeta_id',
        'fechaPago',
        'periodoPago',
        'totalCuotas',
        'totalPagado',
        'totalSeguros'
    ];

    public function tarjeta() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Tarjeta::class);
    }

    public function detalle() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\DetallePagoTarjeta::class, 'pago_id');
    }

    public function descripcionTarjeta(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tarjeta->nombre ?? ''
        );
    }

    public function fechaFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => MiDate::toFormat($this->fecha, 'd/m/Y')
        );
    }

    public function periodoPagoFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => MiDate::toFormat($this->periodoPago, 'd/m/Y')
        );
    }

    public function periodoFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => MiDate::toMonthYearFormat($this->periodoPago)
        );
    }

    public function fechaPagoFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => MiDate::toFormat($this->fechaPago, 'd/m/Y')
        );
    }

    public function totalCuotasFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::moneyArg($this->totalCuotas)
        );
    }

    public function totalPagadoFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::moneyArg($this->totalPagado)
        );
    }

    public function totalSegurosFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::moneyArg($this->totalSeguros)
        );
    }

    public function totalGastosFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::moneyArg($this->total_gastos)
        );
    }

    public function totalGastos(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->totalPagado - ($this->totalSeguros + $this->totalCuotas)
        );
    }

    public function totalPagadoEdit(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::decimalNumber($this->totalPagado)
        );
    }


    public static function ultimo()
    {
        return PagoTarjeta::orderByDesc('periodoPago')
                ->limit(1)
                ->first();
    }
}