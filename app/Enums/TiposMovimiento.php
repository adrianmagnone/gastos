<?php

namespace App\Enums;

enum TiposMovimiento : int
{
    case INGRESO = 1;
    case GASTO   = 2;

    public function label() : string
    {
        return match($this) {
            self::INGRESO => 'Ingreso',
            self::GASTO   => 'Gasto',
        };
    }

    public static function toArray() : array
    {
        return [
            1 => self::INGRESO->label(),
            2 => self::GASTO->label()
        ];
    }
}