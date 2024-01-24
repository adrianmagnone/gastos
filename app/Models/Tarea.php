<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Helpers\DateHelper as MiDate;

class Tarea extends Model
{
    const ESTADOS = [
        1 => 'Finalizada',
        2 => 'Cancelada',
        3 => 'Pendiente'
    ];

    protected $table = "tareas";

    protected $fillable = [
        'fechaCreacion',
        'fechaFinalizacion',
        'estado',
        'descripcion',
        'proyecto',
    ];

    public function fechaCreacionFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => MiDate::toFormat($this->fechaCreacion, 'd/m/Y')
        );
    }


    public function fechaFinalizacionFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->fechaFinalizacion ? MiDate::toFormat($this->fechaFinalizacion, 'd/m/Y') : ''
        );
    }

    public static function pendientes()
    {
        return Tarjeta::where('estado', 0)->get();
    }

    public static function Estado($value)
    {
        $keys = array_keys(self::ESTADOS, $value);

        return $keys[0];
    }
}
