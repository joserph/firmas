<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validity extends Model
{
    use HasFactory;

    public static function getValidityAll()
    {
        return [
            '7 días'    => __('7 días'),
            '30 días'   => __('30 días'),
            '1 año'     => __('1 año'),
            '2 años'    => __('2 años'),
            '3 años'    => __('3 años'),
            '4 años'    => __('4 años'),
        ];
    }

    public static function getValidityYear()
    {
        return [
            '1 año'     => __('1 año'),
            '2 años'    => __('2 años'),
            '3 años'    => __('3 años'),
            '4 años'    => __('4 años'),
        ];
    }
}
