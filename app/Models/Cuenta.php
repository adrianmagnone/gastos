<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Cuenta extends Model
{
    protected $table = "cuentas_facturacion";

    protected $fillable = [
        'nombre',
        'estado'
    ];
}
