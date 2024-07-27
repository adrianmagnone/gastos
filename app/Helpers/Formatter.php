<?php

namespace App\Helpers;

use NumberFormatter;
class Formatter
{
    public static function moneyArg($value) : string
    {
        $formatter = new NumberFormatter("es-AR", NumberFormatter::CURRENCY); 

        return $formatter->format($value);
    }

    public static function money($value) : string
    {
        return \number_format($value, 2, ',', '.'); 
    }

    public static function decimalNumber($value) 
    {
        return number_format($value, 2, '.', ''); 
    }

    public static function zeros($value, $cantidad = 8)
    {
        return str_pad($value, $cantidad, "0", STR_PAD_LEFT);
    }

    public static function dni($value) : string
    {
        $formatter = NumberFormatter::create("es-AR", NumberFormatter::DEFAULT_STYLE);

        return $formatter->format($value);
    }

    public static function number($value) : string
    {
        $formatter = NumberFormatter::create("es-AR", NumberFormatter::DEFAULT_STYLE);

        return $formatter->format($value);
    }

    public static function idFiscal($type, $value) : string
    {
        // switch ($type) {
        //     case 'CUIT':
        //         $formatter = NumberFormatter::create("es-AR", NumberFormatter::PATTERN_RULEBASED, "##-########-#");        
        //         break;
        //     case 'CUIL':
        //         $formatter = NumberFormatter::create("es-AR", NumberFormatter::PATTERN_DECIMAL, "##-########-#");        
        //         break;
        //     default:
        //         $formatter = NumberFormatter::create("es-AR", NumberFormatter::DEFAULT_STYLE);        
        //         break;
        // }
        // return $formatter->format($value);
    }

    public static function percent($value) : string
    {
        $formatter = NumberFormatter::create("es-AR", NumberFormatter::DECIMAL);

        return $formatter->format($value) . ' %';
    }
}