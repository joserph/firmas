<?php

namespace App\Livewire;

use App\Models\Consolidation;
use App\Models\Geography;
use App\Models\Nationalities;
use App\Models\Partner;
use App\Models\Signature;
use App\Models\SignatureFile;
use App\Models\Validity;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Attributes\Url;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class EditCompanyMemberComponent extends Component
{
    use WithFileUploads;
    #[Url]
    public $id;
    public $headerButton = 'warning', $headerText = 'dark', $headerButton2 = '', $headerText2 = '', $currentStep = 1, $nationalities, $f_documentoRL;
    public $selectCedula = 'disabled', $provinces, $cantons = [], $validities, $displayToken = 'none', $totalStep = 2, $f_nombramiento2;
    public $tipo_solicitud, $contenedor, $nombres, $apellido1, $apellido2, $tipodocumento, $numerodocumento, $ruc_personal, $con_ruc, $f_autreprelegal;
    public $sexo, $fecha_nacimiento, $nacionalidad = 'ECUATORIANA', $telfCelular, $telfFijo, $eMail, $provincia, $ciudad, $direccion, $vigenciafirma;
    public $f_cedulaFront, $f_cedulaBack, $f_selfie, $f_copiaruc, $f_adicional1, $f_adicional2, $f_adicional3, $f_adicional4, $aditional1Extension;
    public $requiredCodigoDactilar, $cdactilar, $telfCelular2, $eMail2, $formato, $token, $ruc, $empresa, $cargo, $unidad, $tipodocumentoRL;
    public $numerodocumentoRL, $nombresRL, $apellido1RL, $apellido2RL, $displayVideo = 'none', $videoFile, $f_constitucion, $f_nombramiento;
    public $partners, $partner, $formats, $signature, $rule_f_constitucion = '', $rule_f_nombramiento = '', $rule_f_nombramiento2 = '', $rule_f_documentoRL = '';
    public $rule_f_cedulaFront = '', $rule_f_cedulaBack = '', $rule_f_selfie = '', $rule_videoFile = '', $rule_f_copiaruc = '', $rule_f_adicional2 = '';
    public $rule_f_autreprelegal = '', $signatureFile;

    public function render()
    {
        return view('livewire.edit-company-member-component');
    }

    public function mount()
    {
        $this->nationalities = Nationalities::getNationalities();
        $provincesAll = Geography::select('name_province', 'cod_province')->get()->toArray();
        $this->provinces = array_unique($provincesAll, SORT_REGULAR);
        $this->cantons = collect();
        $this->formats = Signature::getContainer();
        $this->validities = Validity::getValidityAll();
        $this->partners = Partner::orderBy('name', 'ASC')->get();
        // Values imputs
        $this->signature = Signature::find($this->id);
        $this->tipodocumento = $this->signature->tipodocumento;
        $this->numerodocumento = $this->signature->numerodocumento;
        $this->nombres = $this->signature->nombres;
        $this->apellido1 = $this->signature->apellido1;
        $this->apellido2 = $this->signature->apellido2;
        $this->fecha_nacimiento = $this->signature->fecha_nacimiento;
        $this->sexo = $this->signature->sexo;
        $this->nacionalidad = $this->signature->nacionalidad;
        ($this->signature->tipodocumento === 'CEDULA') ? $this->selectCedula = '' : $this->selectCedula = 'disabled';
        $this->cdactilar = $this->signature->cdactilar;
        $this->telfCelular = $this->signature->telfCelular;
        $this->eMail = $this->signature->eMail;
        $this->telfCelular2 = $this->signature->telfCelular2;
        $this->eMail2 = $this->signature->eMail2;
        $this->ruc = $this->signature->ruc;
        $this->empresa = $this->signature->empresa;
        $this->unidad = $this->signature->unidad;
        $this->cargo = $this->signature->cargo;
        $this->tipodocumentoRL = $this->signature->tipodocumentoRL;
        $this->numerodocumentoRL = $this->signature->numerodocumentoRL;
        $this->nombresRL = $this->signature->nombresRL;
        $this->apellido1RL = $this->signature->apellido1RL;
        $this->apellido2RL = $this->signature->apellido2RL;
        $provincia = Geography::where('name_province', $this->signature->provincia)->select('cod_province')->first();
        $this->provincia = $provincia->cod_province;
        $this->updatedProvincia($this->provincia);
        $ciudad = Geography::where('name_canton', $this->signature->ciudad)->select('cod_canton')->first();
        $this->ciudad = $ciudad->cod_canton;
        $this->direccion = $this->signature->direccion;
        $this->formato = $this->signature->formato;
        $this->vigenciafirma = $this->signature->vigenciafirma;
        $this->token = $this->signature->token;
        $consolidation = Consolidation::where('signature_id', $this->signature->id)->first();
        $this->partner = $consolidation->partner_id;
        // Signature File
        $this->signatureFile = SignatureFile::where('signature_id', $this->signature->id)->first();
        $this->f_cedulaFront = $this->signatureFile->f_cedulaFront;
        $this->f_cedulaBack = $this->signatureFile->f_cedulaBack;
        $this->f_selfie = $this->signatureFile->f_selfie;
        $this->f_copiaruc = $this->signatureFile->f_copiaruc;
        $this->f_constitucion = $this->signatureFile->f_constitucion;
        $this->f_nombramiento = $this->signatureFile->f_nombramiento;
        $this->f_nombramiento2 = $this->signatureFile->f_nombramiento2;
        $this->f_adicional2 = $this->signatureFile->f_adicional2;
        $this->f_documentoRL = $this->signatureFile->f_documentoRL;
        $this->f_autreprelegal = $this->signatureFile->f_autreprelegal;
    }

    public function updatedProvincia($value)
    {
        $this->cantons = Geography::orderBy('name_canton', 'asc')->select('cod_canton', 'name_canton')->where('cod_province', $value)->get()->toArray();
    }

    public function changeTypeDocument()
    {
        if($this->tipodocumento === 'PASAPORTE')
        {
            $this->selectCedula = 'disabled';
        }else{
            $this->selectCedula = '';
        }
    }

    public function incrementSteps()
    {
        if($this->currentStep === 1)
        {
            $this->validateForm();
            $this->currentStep++;
            $this->headerButton = 'light';
            $this->headerText = 'dark';
            $this->headerButton2 = 'warning';
            $this->headerText2 = 'dark';
        }
    }

    public function decrementSteps()
    {
        if($this->currentStep === 2)
        {
            $this->currentStep--;
            $this->headerButton = 'warning';
            $this->headerText = 'dark';
            $this->headerButton2 = 'light';
            $this->headerText2 = 'dark';
        }
    }

    public function validateForm()
    {
        ($this->tipodocumento == 'CEDULA') ? $this->requiredCodigoDactilar = 'required' : $this->requiredCodigoDactilar = '';
        if($this->currentStep === 1)
        {
            $this->validate([
                'nombres'           => 'required',
                'apellido1'         => 'required',
                'apellido2'         => 'nullable',
                'tipodocumento'     => 'required',
                'numerodocumento'   => 'required|min:5|max:20',
                'sexo'              => 'required',
                'fecha_nacimiento'  => 'required|date',
                'nacionalidad'      => 'required',
                'cdactilar'         => $this->requiredCodigoDactilar . '|min:6|max:10|nullable',
                'telfCelular'       => 'required|numeric|min_digits:10|max_digits:10',
                'telfCelular2'      => 'numeric|nullable|min_digits:10|max_digits:10',
                'eMail'             => 'required|email',
                'eMail2'            => 'nullable|email',
                'provincia'         => 'required',
                'ciudad'            => 'required',
                'direccion'         => 'required',
                'formato'           => 'required',
                'vigenciafirma'     => 'required',
                'token'             => 'nullable|max:50',
                'ruc'               => 'required|numeric|min_digits:13|max_digits:13',
                'empresa'           => 'required',
                'cargo'             => 'required',
                'unidad'            => 'required',
                'tipodocumentoRL'   => 'required',
                'numerodocumentoRL' => 'required|min:5|max:20',
                'nombresRL'         => 'required',
                'apellido1RL'       => 'required',
                'apellido2RL'       => 'nullable'
            ]);
        }
    }

    public function changeFormat()
    {
        if($this->formato === '1')
        {
            $this->displayToken = 'block';
            $this->validities = Validity::getValidityYear();
            $this->vigenciafirma = '';
        }elseif($this->formato === '3'){
            $this->displayToken = 'none';
            $this->validities = Validity::getValidityYear();
            $this->vigenciafirma = '';
        }elseif($this->formato === '0'){
            $this->displayToken = 'none';
            $this->validities = Validity::getValidityYear();
            $this->vigenciafirma = '';
        }elseif($this->formato === '2'){
            $this->displayToken = 'none';
            $this->validities = Validity::getValidityYear();
            $this->vigenciafirma = '';
        }
    }

    public function saveCompanyMember()
    {
        (gettype($this->f_cedulaFront) === 'object') ? $this->rule_f_cedulaFront = 'required|image|mimes:jpg,png' : '';
        (gettype($this->f_cedulaBack) === 'object') ? $this->rule_f_cedulaBack = 'required|image|mimes:jpg,png' : '';
        (gettype($this->f_selfie) === 'object') ? $this->rule_f_selfie = 'required|image|mimes:jpg,png' : '';
        (gettype($this->videoFile) === 'object') ? $this->rule_videoFile = 'nullable|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:10240' : '';
        (gettype($this->f_copiaruc) === 'object') ? $this->rule_f_copiaruc = 'required|nullable|file|mimes:pdf' : '';
        (gettype($this->f_adicional2) === 'object') ? $this->rule_f_adicional2 = 'nullable|file|mimes:pdf,jpg,png' : '';
        (gettype($this->f_constitucion) === 'object') ? $this->rule_f_constitucion = 'required|file|mimes:pdf' : '';
        (gettype($this->f_nombramiento) === 'object') ? $this->rule_f_nombramiento = 'required|file|mimes:pdf' : '';
        (gettype($this->f_nombramiento2) === 'object') ? $this->rule_f_nombramiento2 = 'nullable|file|mimes:pdf' : '';
        (gettype($this->f_documentoRL) === 'object') ? $this->rule_f_documentoRL = 'nullable|file|mimes:pdf' : '';
        (gettype($this->f_autreprelegal) === 'object') ? $this->rule_f_autreprelegal = 'nullable|file|mimes:pdf' : '';
        if($this->currentStep === 2)
        {
            $this->validate([
                'f_cedulaFront'     => $this->rule_f_cedulaFront,
                'f_cedulaBack'      => $this->rule_f_cedulaBack,
                'f_selfie'          => $this->rule_f_selfie,
                'videoFile'         => $this->rule_videoFile,
                'f_copiaruc'        => $this->rule_f_copiaruc,
                'f_adicional1'      => 'nullable|file|mimes:pdf,jpg,png',
                'f_adicional2'      => $this->rule_f_adicional2,
                'f_adicional3'      => 'nullable|file|mimes:pdf',
                'f_adicional4'      => 'nullable|file|mimes:pdf',
                'f_constitucion'    => $this->rule_f_constitucion,
                'f_nombramiento'    => $this->rule_f_nombramiento,
                'f_nombramiento2'   => $this->rule_f_nombramiento2,
                'f_documentoRL'     => $this->rule_f_documentoRL,
                'f_autreprelegal'   => $this->rule_f_autreprelegal
            ]);

            $companyMember = Signature::find($this->id);
            $companyMember->nombres = Str::upper($this->nombres); //si
            $companyMember->apellido1 = Str::upper($this->apellido1); //si
            $companyMember->apellido2 = Str::upper($this->apellido2); //si
            $companyMember->tipodocumento = $this->tipodocumento; //si
            $companyMember->numerodocumento = $this->numerodocumento; //si
            $companyMember->ruc_personal = $this->ruc_personal;//si
            $companyMember->sexo = $this->sexo;//si
            $companyMember->fecha_nacimiento = $this->fecha_nacimiento;//si
            $companyMember->nacionalidad = $this->nacionalidad;//si
            $companyMember->cdactilar = Str::upper($this->cdactilar);//si
            $companyMember->telfCelular = $this->telfCelular;//si
            $companyMember->telfCelular2 = $this->telfCelular2;//si
            $companyMember->eMail = $this->eMail;//si
            $companyMember->eMail2 = $this->eMail2;//si
            // $companyMember->con_ruc = $this->con_ruc;//si
            $provinciaText = Geography::select('name_province')->where('cod_province', $this->provincia)->first();
            $ciudadText = Geography::select('name_canton')->where('cod_province', $this->provincia)->where('cod_canton', $this->ciudad)->first();
            $companyMember->provincia = $provinciaText->name_province;//si
            $companyMember->ciudad = $ciudadText->name_canton;//si
            $companyMember->direccion = Str::upper($this->direccion);//si
            $companyMember->formato = $this->formato;//si
            $companyMember->vigenciafirma = $this->vigenciafirma;//si
            $companyMember->token = $this->token;//si
            // Legal Representative
            $companyMember->ruc = $this->ruc; //si
            $companyMember->empresa = $this->empresa; //si
            $companyMember->cargo = $this->cargo; //si
            // Company Member
            $companyMember->unidad = $this->unidad; //si
            $companyMember->tipodocumentoRL = $this->tipodocumentoRL; //si
            $companyMember->numerodocumentoRL = $this->numerodocumentoRL; //si
            $companyMember->nombresRL = $this->nombresRL; //si
            $companyMember->apellido1RL = $this->apellido1RL; //si
            $companyMember->apellido2RL = $this->apellido2RL; //si
            $companyMember->estado = 'ACTUALIZADO';
            $companyMember->user_id = Auth::user()->id;

            $companyMember->save();

            // Convert to Base64
            $f_cedulaFront = (gettype($this->f_cedulaFront) === 'object') ? base64_encode(file_get_contents($this->f_cedulaFront->getRealPath())) : $this->f_cedulaFront;
            $f_cedulaBack = (gettype($this->f_cedulaBack) === 'object') ? base64_encode(file_get_contents($this->f_cedulaBack->getRealPath())) : $this->f_cedulaBack;
            $f_selfie = (gettype($this->f_selfie) === 'object') ? base64_encode(file_get_contents($this->f_selfie->getRealPath())) : $this->f_selfie;
            $videoFile = (gettype($this->videoFile) === 'object') ? base64_encode(file_get_contents($this->videoFile->getRealPath())) : $this->videoFile;
            $f_copiaruc = (gettype($this->f_copiaruc) === 'object') ? base64_encode(file_get_contents($this->f_copiaruc->getRealPath())) : $this->f_copiaruc;
            $f_adicional1 = (gettype($this->f_adicional1) === 'object') ? base64_encode(file_get_contents($this->f_adicional1->getRealPath())) : $this->f_adicional1;
            // Legal representative
            $f_constitucion = (gettype($this->f_constitucion) === 'object') ? base64_encode(file_get_contents($this->f_constitucion->getRealPath())) : $this->f_constitucion;
            $f_nombramiento = (gettype($this->f_nombramiento) === 'object') ? base64_encode(file_get_contents($this->f_nombramiento->getRealPath())) : $this->f_nombramiento;
            $f_nombramiento2 = (gettype($this->f_nombramiento2) === 'object') ? base64_encode(file_get_contents($this->f_nombramiento2->getRealPath())) : $this->f_nombramiento2;
            // company member
            $f_documentoRL = (gettype($this->f_documentoRL) === 'object') ? base64_encode(file_get_contents($this->f_documentoRL->getRealPath())) : $this->f_documentoRL;
            $f_autreprelegal = (gettype($this->f_autreprelegal) === 'object') ? base64_encode(file_get_contents($this->f_autreprelegal->getRealPath())) : $this->f_autreprelegal;

            $companyMemberFile = SignatureFile::where('signature_id', $companyMember->id)->first();
            $companyMemberFile->f_cedulaFront = $f_cedulaFront;
            $companyMemberFile->f_cedulaBack = $f_cedulaBack;
            $companyMemberFile->f_selfie = $f_selfie;
            $companyMemberFile->videoFile = $videoFile;
            $companyMemberFile->f_copiaruc = $f_copiaruc;
            $companyMemberFile->f_adicional1 = $f_adicional1;
            // Legal representative
            $companyMemberFile->f_constitucion = $f_constitucion;
            $companyMemberFile->f_nombramiento = $f_nombramiento;
            $companyMemberFile->f_nombramiento2 = $f_nombramiento2;
            // Company Member
            $companyMemberFile->f_documentoRL = $f_documentoRL;
            $companyMemberFile->f_autreprelegal = $f_autreprelegal;
            $companyMemberFile->save();
            // Data for Consolidation
            $consolidation = Consolidation::where('signature_id', $companyMember->id)->first();
            $consolidation->partner_id = $this->partner;
            $consolidation->save();
            
            return redirect()->route('signatures');
        }
    }
}
