<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class TipoComprobante extends Model
{
    const TIPOS = [
        1 => 'Debe',
        2 => 'Haber'
    ];

    protected $table = "tipos_comprobantes";

    protected $fillable = [
        'descripcion',
        'codigoAfip',
        'tipo'
    ];

    public static function findByAfip($value)
    {
        return TipoComprobante::where('codigoAfip', $value)->first();
    }
}