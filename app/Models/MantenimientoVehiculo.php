<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class MantenimientoVehiculo extends Model
{
    protected $table = "mantenimiento_vehiculos";

    protected $fillable = [
        'fecha',
        'vehiculo_id',
        'km',
        'importe',
        'descripcion'
    ];

    public function vehiculo() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Vehiculo::class);
    }

    public function descripcionVehiculo(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->vehiculo->descripcion_completa ?? ''
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

    public function kmFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::number($this->km)
        );
    }
}
