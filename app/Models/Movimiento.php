<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Support\Facades\DB;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class Movimiento extends Model
{
    const TIPOS = [
        1 => 'Ingreso',
        2 => 'Gasto'
    ];

    protected $table = "movimientos";

    protected $fillable = [
        'fecha',
        'tipo',
        'categoria_id',
        'descripcion',
        'importe'
    ];

    public function categoria() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Categoria::class);
    }

    public function descripcionCategoria(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->categoria->nombre ?? ''
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

    public static function Tipo($value)
    {
        $keys = array_keys(self::TIPOS, $value);

        return $keys[0];
    }

    public static function actualizarResumen($anio)
    {
        $anio = (int)$anio;

        DB::statement("DELETE FROM resumen_anual_movimientos WHERE anio = {$anio}");

        DB::statement("INSERT into resumen_anual_movimientos(anio, mes, tipo, categoria_id, importe)
                        SELECT YEAR(fecha), MONTH(fecha), tipo, categoria_id, SUM(importe) as importe
                        FROM movimientos
                        WHERE YEAR(fecha) = {$anio}
                        GROUP BY YEAR(fecha), MONTH(fecha), tipo, categoria_id");
    }
}
