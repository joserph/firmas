<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateMonth extends Model
{
    use HasFactory;

    public static function getYear()
    {
        return [
            '2023'  => __('2023'),
            '2024'  => __('2024'),
        ];
    }

    public static function getMonth()
    {
        return [
            1   => __('ENERO'),
            2   => __('FEBRERO'),
            3   => __('MARZO'),
            4   => __('ABRIL'),
            5   => __('MAYO'),
            6   => __('JUNIO'),
            7   => __('JULIO'),
            8   => __('AGOSTO'),
            9   => __('SEPTIEMBRE'),
            10  => __('OCTUBRE'),
            11  => __('NOVIEMBRE'),
            12  => __('DICIEMBRE'),
        ];
    }
}
