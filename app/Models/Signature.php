<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Signature extends Model
{
    use HasFactory;

    protected $fillable = [
        'creacion',
        'tipo_solicitud',
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
        'unidad',
        'aprobacion',
        'estado',
        'datos',
        'documentos',
        'user_id'
    ];

    public static function getStateSignature()
    {
        return [
            'NUEVO'                 => __('NUEVO'), // La solicitud ha sido ingresada y aún no ha sido revisada.
            'ASIGNADO'              => __('ASIGNADO'), // La solicitud ha sido asignada a un operador de registro para su verificación.
            'EN VALIDACION'         => __('EN VALIDACION'), // La solicitud está siendo revisada por un operador de registro.
            'RECHAZADO'             => __('RECHAZADO'), // La solicitud ha sido rechazada.
            'ELIMINADO'             => __('ELIMINADO'), // La solicitud ha sido eliminada.
            'APROBADO'              => __('APROBADO'), // La solicitud ha sido aprobada y está en espera de que el firmante asigne su clave o PIN.
            'EMITIDO (VALIDO)'      => __('EMITIDO (VALIDO)'), // El firmante ha definido su clave o pin. El certificado de firma electrónica es válido y puede ser utilizado.
            'EMITIDO (SUSPENDIDO)'  => __('EMITIDO (SUSPENDIDO)'), // El certificado ha sido suspendido, no se lo puede utilizar por el momento.
            'EMITIDO (REVOCADO)'    => __('EMITIDO (REVOCADO)'), // El certificado ha sido invalidado, no se lo puede volver a utilizar.
            'EMITIDO (CADUCADO)'    => __('EMITIDO (CADUCADO)'), // El certificado caducó, no se lo puede volver a utilizar.
        ];
    }

    public function consolidations(): HasMany
    {
        return $this->hasMany(Consolidation::class);
    }
}
