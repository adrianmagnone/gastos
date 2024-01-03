<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Tarjeta extends Model
{
    const ESTADOS = [
        0 => 'Baja',
        1 => 'Activo'
    ];

    protected $table = "tarjetas";

    protected $fillable = [
        'nombre',
        'estado'
    ];

    public static function activas()
    {
        return Tarjeta::where('estado', 1)->get();
    }
}
