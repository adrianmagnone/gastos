<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Helpers\DateHelper as MiDate;
use App\Helpers\Formatter;
class CategoriaMonotributo extends Model
{
    protected $table = "categorias_monotributo";

    protected $fillable = [
        'fecha_vigencia',
        'categoria',
        'importe_mensual',
        'importe_anual'
    ];

    public function fechaFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => MiDate::toMonthYearFormat($this->fecha_vigencia)
        );
    }

    public function importeFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::moneyArg($this->importe_anual)
        );
    }

    public function importeAnualEdit(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::money($this->importe_anual)
        );
    }

    public function importeMensualFormat(): Attribute
    {
        return Attribute::make(
            get: fn () => Formatter::moneyArg($this->importe_anual / 12)
        );
    }

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
