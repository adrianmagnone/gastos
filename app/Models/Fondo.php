<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Fondo extends Model
{
    const ESTADOS = [
        0 => 'Baja',
        1 => 'Activo'
    ];

    protected $table = "fondos";

    protected $fillable = [
        'nombre',
        'estado',
    ];

    public static function activos()
    {
        return Categoria::where('estado', 1)->get();
    }
}
