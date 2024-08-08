<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidatedWithBank extends Model
{
    use HasFactory;

    public static function getConsolidatedWithBank()
    {
        return [
            'PENDIENTE'     => __('PENDIENTE'),
            'SIN PAGO'      => __('SIN PAGO'),
            'EN PROCESO'    => __('EN PROCESO'),
            'EN BANCO'      => __('EN BANCO'),
        ];
    }
}
