<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class MovimientoMio extends Model
{
    const TIPOS = [
        1 => 'Ingreso',
        2 => 'Gasto'
    ];

    protected $table = "movimientos_mios";

    protected $fillable = [
        'saldo'
    ];

    public function concepto() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\ConceptoMio::class);
    }

    public function nombreConcepto(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->concepto->nombre ?? ''
        );
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
            get: fn () => Formatter::decimalNumber($this->importe)
        );
    }

    public function nombreTipo(): Attribute
    {
        return Attribute::make(
            get: fn () => self::TIPOS[$this->tipo] ?? ''
        );
    }

    public function esIngreso(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tipo == 1
        );
    }

    public function esGasto(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tipo == 2
        );
    }

    public static function ingresosConSaldo()
    {
        return MovimientoMio::where('tipo', 1)
            ->where('saldo', '>' , 0)
            ->orderBy('fecha')
            ->get();
    }

    public static function gastosConSaldo()
    {
        return MovimientoMio::where('tipo', 2)
            ->where('saldo', '>' , 0)
            ->orderBy('fecha')
            ->get();
    }
}
