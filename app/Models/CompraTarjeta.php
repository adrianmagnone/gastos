<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class CompraTarjeta extends Model
{
    protected $table = "compras_tarjetas";

    protected $fillable = [
        'tarjeta_id',
        'categoria_id',
        'fecha',
        'descripcion',
        'total',
        'importeCuota',
        'cuotas',
        'cuotasPendientes',
        'periodoInicial'
    ];

    public function tarjeta() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Tarjeta::class);
    }

    public function categoria() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Categoria::class);
    }

    public function descripcionTarjeta(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tarjeta->nombre ?? ''
        );
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

    public function periodoFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => MiDate::toFormat($this->periodoInicial, 'd/m/Y')
        );
    }

    public function totalFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::moneyArg($this->total)
        );
    }

    public function importeCuotaFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::moneyArg($this->importeCuota)
        );
    }

    public function importeCuotaEdit(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::money($this->importeCuota)
        );
    }

    public function totalEdit(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::money($this->total)
        );
    }

    public function sePuedeEliminar()
    {
        if ($this->cuotas != $this->cuotasPendientes)
        {
            $this->mensajeValidacion = "No se puede eliminar la Compra con Tarjeta porque ya existen cuotas pagas";
            return false;
        }

        return true;
    }
}
