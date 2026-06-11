<?php

namespace App\Lib\ArchivoBancos;    

use App\Helpers\Formatter;

class LeerRegistros
{
    /*
    * 0 => string '09/10/2023' (length=10)   Fecha del movimiento
    * 1 => string '69200' (length=5)         Identificacion o tipo de movimiento
    * 2 => string 'SANCOR SALUD' (length=12) Descripcion
    * 3 => string '-15092,13' (length=9)     Importe del movimiento
    * 4 => string '146810,76' (length=9)     Saldo
    */
    public static function BancoMacro(&$record)
    {
        $importe = (float)str_replace (',', '.', $record[3]);
        $cuit    = '';

        if ($importe == 0)
            return false;
        
        if (preg_match('/[0-9]{8,11}/', $record[2], $matches))
            $cuit = $matches[0];

        return [
            'tipo'           => ($importe < 0) ? 'Gasto' : 'Ingreso',
            'importe'        => \abs($importe),
            'importeFormat'  => Formatter::moneyArg($importe),
            'fecha'          => $record[0],
            'descripcion'    => $record[2],
            'cuit'           => $cuit   
        ];
    }

    /*
    * 0 => string '' (length=0)
    * 1 => string '28/09/2023' (length=10)        Fecha
    * 2 => string '' (length=0)
    * 3 => string 'MERCADOPAGO*MCART' (length=0)  Descripcion del Movimiento
    * 4 => string '' (length=0)
    * 5 => string '' (length=0)
    * 6 => string '' (length=0)
    * 7 => string '' (length=0)
    * 8 => string '' (length=0)
    * 9 => string '' (length=0)
    * 10 => string '' (length=0)
    * 11 => string '' (length=0)
    * 12 => string '' (length=0)
    * 13 => string '' (length=0)
    * 14 => string '-6250' (length=5)             Importe del Movimiento
    * 15 => string '' (length=0)
    * 16 => string '20699,67' (length=8)          Saldo 
    */
    public static function BancoHipotecario(&$record)
    {
        $importe = (float)str_replace (',', '.', $record[14]);
        $cuit    = '';
        
        if (preg_match('/[0-9]{8,11}/', $record[3], $matches))
            $cuit = $matches[0];

        if ($importe == 0)
            return false;

        return  [
            'tipo'           => ($importe < 0) ? 'Gasto' : 'Ingreso',
            'importe'        => \abs($importe),
            'importeFormat'  => Formatter::moneyArg($importe),
            'fecha'          => $record[1],
            'descripcion'    => $record[3],
            'cuit'           => $cuit   
        ];
    }

    /*
    * 0 => string '28/09/2023' (length=10)        Fecha
    * 1 => string 'MERCADOPAGO*MCART' (length=0)  Descripcion del Movimiento
    * 2 => string '-6250' (length=5)             Importe del Movimiento
    * 3 => string '20699,67' (length=8)          Saldo 
    */
    public static function BancoHipotecario2026(&$record)
    {
        $importe = str_replace ('.', '', $record[2]);
        $importe = (float)str_replace (',', '.', $importe);
        $cuit    = '';

        if ($importe == 0)
            return false;
        
        if (preg_match('/[0-9]{8,11}/', $record[1], $matches))
            $cuit = $matches[0];

        return [
            'tipo'           => ($importe < 0) ? 'Gasto' : 'Ingreso',
            'importe'        => \abs($importe),
            'importeFormat'  => Formatter::moneyArg($importe),
            'fecha'          => $record[0],
            'descripcion'    => $record[1],
            'cuit'           => $cuit   
        ];
    }
}