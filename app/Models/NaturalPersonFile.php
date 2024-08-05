<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NaturalPersonFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'f_cedulaFront',
        'f_cedulaBack',
        'f_selfie',
        'videoFile',
        'f_copiaruc',
        'f_adicional1',
    ];
}
