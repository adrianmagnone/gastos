<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Categoria extends Model
{
    const USOS = [
        1 => 'Ingreso',
        2 => 'Gasto',
        3 => 'Ambos'
    ];

    const ESTADOS = [
        0 => 'Baja',
        1 => 'Activo'
    ];

    protected $table = "categorias";

    protected $fillable = [
        'nombre',
        'estado',
        'uso'
    ];

    public static function activas()
    {
        return Categoria::where('estado', 1)->get();
    }

    public static function paraIngresos()
    {
        return Categoria::where('estado', 1)
                ->whereRaw('(uso = 1 OR uso = 3)')
                ->get();
    }

    public static function paraEgresos()
    {
        return Categoria::where('estado', 1)
                ->whereRaw('(uso = 2 OR uso = 3)')
                ->get();
    }
}
