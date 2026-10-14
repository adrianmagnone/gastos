<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Support\Facades\DB;

use App\Enums\TiposMovimiento;
use App\Enums\PagosMovimiento;
use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class Movimiento extends Model
{
    protected $table = "movimientos";

    protected $fillable = [
        'fecha',
        'tipo',
        'categoria_id',
        'descripcion',
        'importe',
        'tipoPago',
        'ticket_id'
    ];

    /**
    * Get the attributes that should be cast.
    *
    * @return array<string, string>
    */
    protected function casts(): array
    {
        return [
            'tipo'     => TiposMovimiento::class,
            'tipoPago' => PagosMovimiento::class
        ];
    }

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

    public static function gastoDesdeImporte($importe, $fecha)
    {
        $fecha = MiDate::fromFormatTo('d/m/Y', $fecha, 'Y-m-d'); 
        
        return Movimiento::where('tipo', TiposMovimiento::GASTO)
                        ->where('importe', $importe)
                        ->whereRaw("ticket_id IS NULL")
                        ->whereRaw("fecha BETWEEN DATE_SUB('{$fecha}', INTERVAL 3 DAY) AND '{$fecha}'")
                        ->get();
    }
}
