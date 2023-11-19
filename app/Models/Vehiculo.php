<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Vehiculo extends Model
{
    const ESTADOS = [
        0 => 'Baja',
        1 => 'Activo'
    ];

    protected $table = "vehiculos";

    protected $fillable = [
        'descripcion',
        'modelo',
        'patente',
        'color',
        'estado'
    ];

    public function descripcionCompleta(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->descripcion} {$this->modelo} ({$this->patente})"
        );
    }

    // public static function Estado($value)
    // {
    //     $keys = array_keys(self::ESTADOS, $value);

    //     return $keys[0];
    // }

    public static function activos()
    {
        return Vehiculo::where('estado', 1)->get();
    }
}
