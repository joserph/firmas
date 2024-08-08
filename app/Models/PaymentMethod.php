<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    public static function getPaymentMethod()
    {
        return [
            'DEPOSITO BANCO DEL BARRIO'     => __('DEPOSITO BANCO DEL BARRIO'),
            'DEPOSITO DIRECTO'              => __('DEPOSITO DIRECTO'),
            'EFECTIVO'                      => __('EFECTIVO'),
            'TRANSFERENCIA OTROS BANCOS'    => __('TRANSFERENCIA OTROS BANCOS'),
            'TRANSFERENCIA PACIFICO'        => __('TRANSFERENCIA PACIFICO'),
            'TRANSFERENCIA PICHINCHA'       => __('TRANSFERENCIA PICHINCHA'),
            'TRANSFERENCIA PRODUBANCO'      => __('TRANSFERENCIA PRODUBANCO')
        ];
    }
}
