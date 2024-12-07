<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CategoriaMonotributo extends Model
{
    protected $table = "categorias_monotributo";

    protected $fillable = [
        'fecha_vigencia',
        'categoria',
        'importe_mensual',
        'importe_anual'
    ];

    public static function vigentesAlPeriodo($periodo)
    {
        $fecha = CategoriaMonotributo::where('fecha_vigencia', '<=', $periodo)->orderBy('fecha_vigencia', 'DESC')->first();

        if ($fecha)
        {
            return CategoriaMonotributo::where('fecha_vigencia', $fecha->fecha_vigencia)->get();
        }

        return false;
    }
}
