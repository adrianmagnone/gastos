<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class MovimientoFondo extends Model
{
    const TIPOS = [
        1 => 'Ingreso',
        2 => 'Gasto'
    ];

    protected $table = "movimientos_fondos";

    protected $fillable = [
        'saldo'
    ];

    public function concepto() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\ConceptoFondo::class);
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

    public static function ingresosConSaldo($idFondo)
    {
        return MovimientoFondo::where('tipo', 1)
            ->where('fondo_id', $idFondo)
            ->where('saldo', '>' , 0)
            ->orderBy('fecha')
            ->get();
    }

    public static function gastosConSaldo($idFondo)
    {
        return MovimientoFondo::where('tipo', 2)
            ->where('fondo_id', $idFondo)
            ->where('saldo', '>' , 0)
            ->orderBy('fecha')
            ->get();
    }
}
