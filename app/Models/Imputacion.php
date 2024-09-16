<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Imputacion extends Model
{
    protected $table = "imputaciones";

    protected $fillable = [
        'comprobante_debe',
        'comprobante_haber',
        'importe'
    ];
}
