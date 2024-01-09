<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class ResumenAnual extends Model
{
    protected $table = "resumen_anual_movimientos";

    protected $fillable = [
        'anio',
        'mes',
        'tipo',
        'categoria_id',
        'importe'
    ];

    public function categoria() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Categoria::class);
    }

    public function descripcionCategoria(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->categoria->nombre ?? ''
        );
    }

    public function importeFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::moneyArg($this->importe)
        );
    }
}
