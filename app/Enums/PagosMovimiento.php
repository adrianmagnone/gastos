<?php

namespace App\Enums;

enum PagosMovimiento : int
{
    case SIN_ESPECIFICAR = 0;
    case EFECTIVO = 1;
    case TARJETA_CREDITO = 2;
    case TARJETA_DEBITO = 3;
    case TRANSFERENCIA = 4;
    case CHEQUE = 5;
    case BILLETERA_VIRTUAL = 6;
    case PAGO_BANCARIO = 7;
    case OTRO = 99;

    public function label() : string
    {
        return match($this) {
            self::SIN_ESPECIFICAR   => 'Sin especificar',
            self::EFECTIVO          => 'Efectivo',
            self::TARJETA_CREDITO   => 'Tarjeta de credito',
            self::TARJETA_DEBITO    => 'Tarjeta de debito',
            self::TRANSFERENCIA     => 'Transferencia',
            self::CHEQUE            => 'Cheque',
            self::BILLETERA_VIRTUAL => 'Billetera virtual',
            self::PAGO_BANCARIO     => 'Pago Bancario',
            self::OTRO              => 'Otro',
            default                 => 'Sin especificar',
        };
    }

    public static function toArray() : array
    {
        return [
            0  => self::SIN_ESPECIFICAR->label(),
            1  => self::EFECTIVO->label(),
            2  => self::TARJETA_CREDITO->label(),
            3  => self::TARJETA_DEBITO->label(),
            4  => self::TRANSFERENCIA->label(),
            5  => self::CHEQUE->label(),
            6  => self::BILLETERA_VIRTUAL->label(),
            7  => self::PAGO_BANCARIO->label(),
            99 => self::OTRO->label(),
        ];
    }

    public static function toIconArray() : array
    {
        return [
            [ 'value' => 1,  'text' => self::EFECTIVO->label(),          'icon' => 'ti ti-cash' ],
            [ 'value' => 2,  'text' => self::TARJETA_CREDITO->label(),   'icon' => 'ti ti-credit-card' ],
            [ 'value' => 3,  'text' => self::TARJETA_DEBITO->label(),    'icon' => 'ti ti-credit-card-hand' ],
            [ 'value' => 4,  'text' => self::TRANSFERENCIA->label(),     'icon' => 'ti ti-transaction-dollar' ],
            [ 'value' => 5,  'text' => self::CHEQUE->label(),            'icon' => 'ti ti-cash-banknote' ],
            [ 'value' => 6,  'text' => self::BILLETERA_VIRTUAL->label(), 'icon' => 'ti ti-wallet' ],
            [ 'value' => 7,  'text' => self::PAGO_BANCARIO->label(),     'icon' => 'ti ti-building-bank' ],
            [ 'value' => 99, 'text' => self::OTRO->label(),              'icon' => 'ti ti-coin-off'   ] 
        ];
    }
}