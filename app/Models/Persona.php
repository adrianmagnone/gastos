<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;

class Persona extends Model
{
    protected $table = "personas";

    protected $fillable = [
        'nombre',
        'abreviatura',
        'tipoDocumento',
        'identificador'
    ];

    public function abreviaturaCuit(): Attribute
    {
        return Attribute::make(
            get: fn () => ($this->abreviatura)
                            ? "({$this->identificador}) " . $this->abreviatura
                            : "({$this->identificador}) " . $this->nombre
        );
    }

    public static function findByIdFiscal($id)
    {
        return Persona::where('identificador', $id)->first();
    }

    public static function allByAbrev()
    {
        return Persona::orderBy('abreviatura')->get();
    }
}