<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ConceptoMio extends Model
{
    protected $table = "conceptos_mios";

    protected $fillable = [
        'nombre'
    ];
}
