<?php

namespace App\Livewire;

use App\Models\Signature;
use App\Models\SignatureFile;
use App\Models\TypeSignature;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class SignatureComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $sortColumn = 'creacion', $sortDirection = 'DESC', $perPage = 10, $search = '', $stateSignatures, $sendButton = 'disabled';
    public $tipo_solicitud;

    public function mount()
    {
        $this->stateSignatures = Signature::getStateSignature();
        // $this->sendButton = ()
    }
    public function render()
    {
        return view('livewire.signature-component', [
            'signatures' => Signature::orderBy($this->sortColumn, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }

    public function doSort($column)
    {
        if($this->sortColumn === $column)
        {
            $this->sortDirection = ($this->sortDirection == 'ASC') ? 'DESC' : 'ASC';
            return;
        }
        $this->sortColumn = $column;
        $this->sortDirection = 'ASC';
    }

    public function changeInputSelect($signature_id, $value, $name)
    {
        $consolidation = Signature::find($signature_id);
        $consolidation->update([
            $name => $value
        ]);
        $termino = Str::of($name)->headline();
        $this->dispatch('success', ['message' => $termino . ' actualizada con exito!']);
    }

    public function sendingSignature($id)
    {
        sleep(4);
        // Search Signature
        $signature = Signature::find($id);
        $signature_files = SignatureFile::where('signature_id', $signature->id)->first();
        $signatureData = '';
        // dd($signature->tipo_solicitud);
        if($signature->tipo_solicitud === '1')
        {
            $signatureData = array(
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
            
        }elseif($signature->tipo_solicitud === '2')
        {
            $signatureData = array(
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
                // 'ruc_personal' => $signature->ruc_personal,
                'sexo' => $signature->sexo,
                'fecha_nacimiento' => date('Y/m/d', strtotime($signature->fecha_nacimiento)),
                'nacionalidad' => $signature->nacionalidad,
                'telfCelular' => $signature->telfCelular,
                'telfFijo' => '',
                'eMail' => $signature->eMail,
                'telfCelular2' => $signature->telfCelular2,
                'eMail2' => $signature->eMail2,
                'empresa' => $signature->empresa,
                'ruc_empresa' => $signature->ruc,
                'cargo' => $signature->cargo,
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
                'f_nombramiento' => $signature_files->f_nombramiento,
                'f_nombramiento2' => $signature_files->f_nombramiento2,
                'f_constitucion' => $signature_files->f_constitucion,
                'f_adicional1' => $signature_files->videoFile,
                'f_adicional2' => $signature_files->f_adicional2,
                'f_adicional3' => $signature_files->f_adicional3,
                'f_adicional4' => $signature_files->f_adicional4
            );
            
        }elseif($signature->tipo_solicitud === '3')
        {
            $signatureData = array(
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
                // 'ruc_personal' => $signature->ruc_personal,
                'sexo' => $signature->sexo,
                'fecha_nacimiento' => date('Y/m/d', strtotime($signature->fecha_nacimiento)),
                'nacionalidad' => $signature->nacionalidad,
                'telfCelular' => $signature->telfCelular,
                'telfFijo' => '',
                'eMail' => $signature->eMail,
                'telfCelular2' => $signature->telfCelular2,
                'eMail2' => $signature->eMail2,
                'empresa' => $signature->empresa,
                'ruc_empresa' => $signature->ruc,
                'cargo' => $signature->cargo,
                'motivo' => '',
                'unidad' => $signature->unidad,
                'provincia' => $signature->provincia,
                'ciudad' => $signature->ciudad,
                'direccion' => $signature->direccion,
                'IdAgenteMovil' => '',
                'nombresRL' => $signature->nombresRL,
                'apellidosRL' => $signature->apellido1RL . ' ' . $signature->apellido2RL,
                'tipodocumentoRL' => $signature->tipodocumentoRL,
                'numerodocumentoRL' => $signature->numerodocumentoRL,
                'vigenciafirma' => $signature->vigenciafirma,
                'coddescuento' => '',
                'f_cedulaFront' => $signature_files->f_cedulaFront,
                'f_cedulaBack' => $signature_files->f_cedulaBack,
                'f_selfie' => $signature_files->f_selfie,
                'f_copiaruc' => $signature_files->f_copiaruc,
                'f_nombramiento' => $signature_files->f_nombramiento,
                'f_nombramiento2' => $signature_files->f_nombramiento2,
                'f_constitucion' => $signature_files->f_constitucion,
                'f_documentoRL' => $signature_files->f_documentoRL,
                'f_autreprelegal' => $signature_files->f_autreprelegal,
                'f_adicional1' => $signature_files->videoFile,
                'f_adicional2' => $signature_files->f_adicional2,
                'f_adicional3' => $signature_files->f_adicional3,
                'f_adicional4' => $signature_files->f_adicional4
            );
        }
        // dd($signatureData);
        // Connect with the API Uanataca
        $url = 'https://api.uanataca.ec/v4/solicitud';
        $ch = curl_init($url);
        $payload = json_encode($signatureData);
        
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        curl_close($ch);
        $valid = json_decode($result,true);
        // dd($valid);
        $fecha_env_firma = date("Y-m-d H:i:s");

        if($valid['result'] == true){
            // $naturalPerson = new Signature;
            $signature->fecha_env_firma = $fecha_env_firma;
            $signature->estado = 'NUEVO';
            $signature->code = $valid['token'];
            $signature->save();
            // return redirect()->route('signatures')->with('send', $valid['message']);
            $this->dispatch('send', ['message' => $valid['message']]);
        }else{
            // return redirect()->route('signatures')->with('error_send', $valid['message']);
            $this->dispatch('error_send', ['message' => $valid['message']]);
        }

        // dd($naturalPersonData);
    }

    public function signatureStatusQuery($id)
    {
        sleep(4);
        $signature = Signature::find($id);
        $type_signatures = TypeSignature::getTypeSignature();
        foreach($type_signatures as $key => $item)
        {
            if($key === intval($signature->tipo_solicitud))
            {
                $this->tipo_solicitud = $item;
            }
        }
        // Check signature type
        $documentType = '';
        if($signature->tipo_solicitud === '1')
        {
            $documentType = $signature->numerodocumento;
        }elseif($signature->tipo_solicitud === '2')
        {
            $documentType = $signature->ruc;
        }elseif($signature->tipo_solicitud === '3')
        {

        }
        $signatureData = array(
            'apikey' => env('UANA_APIKEY'),
            'uid' => env('UANA_PASS_UID'),
            'numerodocumento' => $documentType,
            'tipo_solicitud' => $this->tipo_solicitud
        );
        
        // Connect with the API Uanataca
        $url = 'https://api.uanataca.ec/v4/consultarEstado';
        $ch = curl_init( $url );
        $payload = json_encode($signatureData);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        curl_close($ch);
        $valid = json_decode($result,true);
        if($valid['result'] == true)
        {
            $responseResults = collect($valid['data']['solicitudes']);
            $estado = '';
            $observacion = '';
            foreach($responseResults as $key => $item)
            {
                $uid_uana = str_replace('API-', '', $item['uid']);
                $uid = strpos($signature->code, $uid_uana);
                if($uid)
                {
                    $estado = $item['estado'];
                    $observacion = $item['observacion'];
                }
            }
            $signature->estado = $estado;
            $signature->observacion = $observacion;
            $signature->save();
            $this->dispatch('send', ['message' => 'El estado de la firma es: ' . $estado]);
        }else{
            $this->dispatch('error_send', ['message' => $valid['responce']]);
        }
    }
}
