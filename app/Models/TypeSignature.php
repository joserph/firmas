<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeSignature extends Model
{
    use HasFactory;

    public static function getTypeSignature()
    {
        return [
            1   => __('PERSONA NATURAL'),
            2   => __('REPRESENTANTE LEGAL'),
            3   => __('MIEMBRO DE EMPRESA'),
        ];
    }
}
