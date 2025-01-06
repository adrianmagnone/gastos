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

    public static function actualizarResumen($fecha, $cuenta)
    {
        $fecha   = MiDate::fromFormatTo('d/m/Y', $fecha, 'Y-m-d');
        $periodo = MiDate::object($fecha);

        $ym    = $periodo->format('Y-m');
        $year  = $periodo->format('Y');
        $month = $periodo->format('m');

        \DB::statement("DELETE FROM resumen_facturacion WHERE cuenta_id = {$cuenta} AND periodo = \"{$ym}-01\"");

        \DB::statement("INSERT into resumen_facturacion(anio, mes, cuenta_id, periodo, importe)
                        SELECT YEAR(c.fecha), MONTH(c.fecha), c.cuenta_id, '{$periodo->format('Y-m-d')}',
                            SUM(
                                CASE 
                                    WHEN t.codigoAfip in (1,2,11,12) THEN importe
                                    WHEN t.codigoAfip IN (3,13) THEN importe * -1
                                    ELSE 0
                                END
                            ) as importe
                        FROM cuentas_corrientes_facturacion c
                            INNER JOIN tipos_comprobantes t ON c.tipoComprobante_id = t.id
                        WHERE YEAR(c.fecha) = {$year} AND MONTH(c.fecha) = {$month} AND c.cuenta_id = {$cuenta}
                        GROUP BY YEAR(c.fecha), MONTH(c.fecha), c.cuenta_id");
    }
}
