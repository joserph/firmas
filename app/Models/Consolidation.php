<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consolidation extends Model
{
    use HasFactory;

    protected $fillable = [
        'creacion_signature',
        'signature_id',
        'partner_id',
        'penalidad',
        'monto_pagado',
        'monto_uanataca',
        'ganancia',
        'saldo',
        'consolidado_banco',
        'estado_pago',
        're_verificado',
        'banco',
        'ref_banco',
        'ref_deposito',
        'modo_pago',
        'fecha_pago',
        'nota',
        'en_uanataca'
    ];

    public function signature()
    {
        return $this->belongsTo(Signature::class);
    }

}
