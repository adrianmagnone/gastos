<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class CuentaCorriente extends Model
{
    protected $table = "cuentas_corrientes_facturacion";

    protected $fillable = [
        'cuenta_id',
        'fecha',
        'tipoComprobante_id',
        'puntoVenta',
        'numeroComprobante',
        'tipoDocumento',
        'identificadorComprador',
        'persona_id',
        'importe',
        'importeNoGravado',
        'importePercepcion',
        'importeExento',
        'importePercepcionNacional',
        'importePercepcionIB',
        'importePercepcionMunicipal',
        'importeImpuestoInterno',
        'saldo',
        'columna'
    ];

    public function persona() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Persona::class);
    }

    public function tipoComprobante() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\TipoComprobante::class, 'tipoComprobante_id');
    }

    public function nombrePersona(): Attribute
    {
        return Attribute::make(
            get: fn () => ($this->persona->abreviatura) ? $this->persona->abreviatura : $this->persona->nombre
        );
    }

    public function comprobante(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tipoComprobante->descripcion . ' ' . Formatter::zeros($this->puntoVenta, 5) . '-' . Formatter::zeros($this->numeroComprobante)
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
            get: fn () => Formatter::money($this->importe)
        );
    }

    public function saldoFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::money($this->saldo)
        );
    }

    public function debe(): Attribute
    {
        return Attribute::make(
            get: fn () => ($this->columna == 'D') ? $this->importe : 0
        );
    }

    public function haber(): Attribute
    {
        return Attribute::make(
            get: fn () => ($this->columna == 'H') ? $this->importe : 0
        );
    }

    public static function ultimoNumeroRecibo()
    {
        $ultimoRecibo = CuentaCorriente::where('tipoComprobante_id', config('define.comprobantes.recibos'))
                                       ->where('puntoVenta', 1)
                                       ->orderBy('numeroComprobante', 'desc')
                                       ->first();

        if ($ultimoRecibo)
            return $ultimoRecibo->numeroComprobante;

        return 0;
    }

    public static function ultimoNumeroGasto()
    {
        $ultimoRecibo = CuentaCorriente::where('tipoComprobante_id', config('define.comprobantes.gastos'))
                                       ->where('puntoVenta', 1)
                                       ->orderBy('numeroComprobante', 'desc')
                                       ->first();

        if ($ultimoRecibo)
            return $ultimoRecibo->numeroComprobante;

        return 0;
    }

    public static function debeConSaldo($cuenta, $persona)
    {
        return CuentaCorriente::where('cuenta_id', $cuenta)
                              ->where('persona_id', $persona)  
                              ->where('columna', 'D')
                              ->where('saldo', '>', 0)
                              ->get();
    }

    public static function haberConSaldo($cuenta, $persona)
    {
        return CuentaCorriente::where('cuenta_id', $cuenta)
                              ->where('persona_id', $persona)  
                              ->where('columna', 'H')
                              ->where('saldo', '>', 0)
                              ->get();
    }

}