<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipodocumento',
        'numerodocumento',
        'nombres',
        'apellido1',
        'apellido2',
        'fecha_nacimiento',
        'sexo',
        'nacionalidad',
        'cdactilar',
        'telfCelular',
        'eMail',
        'telfCelular2',
        'eMail2',
        'con_ruc',
        'ruc_personal',
        'provincia',
        'ciudad',
        'direccion',
        'formato',
        'vigenciafirma',
        'token',
        'ruc',
        'empresa',
        'cargo',
    ];
}
