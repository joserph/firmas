<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use App\Models\SignatureFile;
use Illuminate\Http\Request;

class UanatacaController extends Controller
{
    public function sendingSignature($id)
    {
        // dd(env('UANA_APIKEY'));
        // Search Signature
        $signature = Signature::find($id);
        $signature_files = SignatureFile::where('signature_id', $signature->id)->first();
        // dd($signature_files);
        
        $naturalPersonData = array(
            'apikey' => env('UANA_APIKEY'),
            'uid' => env('UANA_PASS_UID'),
            'tipo_solicitud' => $signature->tipo_solicitud,
            'contenedor' => $signature->formato,
            'serial_token' => $signature->token,
            'nombres' => $signature->nombres,
            'apellido1' => $signature->apellido1,
            'apellido2' => $signature->apellido2,
            'tipodocumento' => $signature->tipodocumento,
            'numerodocumento' => $signature->numerodocumento,
            'coddactilar' => $signature->cdactilar,
            'ruc_personal' => $signature->ruc_personal,
            'sexo' => $signature->sexo,
            'fecha_nacimiento' => date('Y/m/d', strtotime($signature->fecha_nacimiento)),
            'nacionalidad' => $signature->nacionalidad,
            'telfCelular' => $signature->telfCelular,
            'telfFijo' => '',
            'eMail' => $signature->eMail,
            'telfCelular2' => $signature->telfCelular2,
            'eMail2' => $signature->eMail2,
            'provincia' => $signature->provincia,
            'ciudad' => $signature->ciudad,
            'direccion' => $signature->direccion,
            'IdAgenteMovil' => '',
            'vigenciafirma' => $signature->vigenciafirma,
            'coddescuento' => '',
            'f_cedulaFront' => $signature_files->f_cedulaFront,
            'f_cedulaBack' => $signature_files->f_cedulaBack,
            'f_selfie' => $signature_files->f_selfie,
            'f_copiaruc' => $signature_files->f_copiaruc,
            'f_adicional1' => $signature_files->videoFile,
            'f_adicional2' => $signature_files->f_adicional2,
            'f_adicional3' => $signature_files->f_adicional3,
            'f_adicional4' => $signature_files->f_adicional4
        );
        // dd($naturalPersonData);
        $url = 'https://api.uanataca.ec/v4/solicitud';
        $ch = curl_init($url);
        $payload = json_encode($naturalPersonData);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        curl_close($ch);
        $valid = json_decode($result,true);
        $fecha_env_firma = date("Y-m-d H:i:s");
        // "{"message":"Solicitud de persona natural recibida correctamente.","token":"99x333f6002839017001725468500","result":true}" 
        // dd($valid);
        if($valid['result'] == true){
            // $naturalPerson = new Signature;
            $signature->fecha_env_firma = $fecha_env_firma;
            $signature->estado = 'EN VALIDACION';
            $signature->save();
            return redirect()->route('signatures')->with('send', $valid['message']);
        }else{
            return redirect()->route('signatures')->with('error_send', $valid['message']);
        }
        
        
        // dd('Algo');
        
    }
}
