<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    use HasFactory;

    public static function getPaymentStatus()
    {
        return [
            'PENDIENTE'     => __('PENDIENTE'),
            'SIN PAGO'      => __('SIN PAGO'),
            'EN PROCESO'    => __('EN PROCESO'),
            'PAGADO'        => __('PAGADO'),
        ];
    }
}
