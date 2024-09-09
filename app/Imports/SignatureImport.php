<?php

namespace App\Imports;

use App\Models\Consolidation;
use App\Models\Price;
use App\Models\Signature;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class SignatureImport implements WithHeadingRow, ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            // Format Date
            $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha']);
            // Validated Cedula or RUC
            if($row['tipo_firma'] === 'REPRESENTANTE LEGAL' || $row['tipo_firma'] === 'MIEMBRO DE EMPRESA')
            {
                $ruc = $row['id'];
                $nombreID = strrchr($row['nombre'], ':');
                $cedula = intval(preg_replace('/[^0-9]+/', '', $nombreID), 10);
                $nombre_ = strrchr($nombreID, '-');
                $specials = array("- ", "-", "]");
                $nombre = str_replace($specials, '', $nombre_);
                // Company
                $empresa_ = strstr($row['nombre'], '[', true);
                $empresa = rtrim($empresa_);
                if($row['tipo_firma'] === 'REPRESENTANTE LEGAL')
                {
                    $tipo_firma = 2;
                }else{
                    $tipo_firma = 3;
                }
            }else{
                $ruc = NULL;
                $cedula = $row['id'];
                $nombre = $row['nombre'];
                $empresa = NULL;
                $tipo_firma = 1;
            }

            if(strlen($cedula) === 10)
            {
                $tipodocumento = 'CEDULA';
            }else{
                $tipodocumento = 'PASAPORTE';
            }
            // Date Aprobation
            $aprobacion = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['aprobacion']);

            $signature = Signature::create([
                'creacion'          => $date->format('Y-m-d h:i:s'),
                'tipo_solicitud'    => $tipo_firma,
                'numerodocumento'   => $cedula,
                'nombres'           => $nombre,
                'datos'             => $row['datos'],
                'documentos'        => $row['documentos'],
                'vigenciafirma'     => $row['vigencia'],
                'formato'           => strtoupper($row['contenedor']),
                'aprobacion'        => $aprobacion->format('Y-m-d h:i:s'),
                'estado'            => $row['estado'],
                'ruc'               => $ruc,
                'empresa'           => $empresa,
                'tipodocumento'     => $tipodocumento,
                'user_id'           => Auth::user()->id
            ]);
            // Price Signature
            $price_signature = Price::where('validity', $row['vigencia'])->where('type_price', 'NORMAL')->select('amount')->first();
            // Price Uanataca
            $price_aunataca = Price::where('validity', $row['vigencia'])->where('type_price', 'UANATACA')->select('amount')->first();
            // dd($price_aunataca->amount);
            // dd($signature->creacion);
            Consolidation::create([
                'creacion_signature'    => $signature->creacion,
                'signature_id'          => $signature->id,
                'monto_pagado'          => $price_signature->amount,
                'monto_uanataca'        => $price_aunataca->amount,
                'consolidado_banco'     => 'PENDIENTE',
                'estado_pago'           => 'PENDIENTE',
                'penalidad'             => 0
            ]);
        }
        
    }
}
