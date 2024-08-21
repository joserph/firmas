<?php

namespace App\Livewire;

use App\Models\Geography;
use App\Models\Nationalities;
use App\Models\Signature;
use App\Models\SignatureFile;
use App\Models\Validity;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;

class LegalRepresentativeComponent extends Component
{
    use WithFileUploads;

    public $headerButton = 'primary', $headerText = 'light', $headerButton2 = '', $headerText2 = '', $currentStep = 1, $nationalities;
    public $selectCedula = 'disabled', $provinces, $cantons = [], $validities, $displayToken = 'none', $totalStep = 2;
    public $tipo_solicitud, $contenedor, $nombres, $apellido1, $apellido2, $tipodocumento, $numerodocumento, $ruc_personal, $con_ruc;
    public $sexo, $fecha_nacimiento, $nacionalidad = 'ECUATORIANA', $telfCelular, $telfFijo, $eMail, $provincia, $ciudad, $direccion, $vigenciafirma;
    public $f_cedulaFront, $f_cedulaBack, $f_selfie, $f_copiaruc, $f_adicional1, $f_adicional2, $f_adicional3, $f_adicional4;
    public $cdactilar, $telfCelular2, $eMail2, $ConRuc, $formato, $requiredCodigoDactilar, $videoFile, $f_nombramiento, $f_constitucion;
    public $token, $displayVideo = 'none', $aditional1Extension, $ruc, $empresa, $cargo, $f_nombramiento2;

    public function render()
    {
        return view('livewire.legal-representative-component');
    }

    public function mount()
    {
        $this->nationalities = Nationalities::getNationalities();
        $provincesAll = Geography::select('name_province', 'cod_province')->get()->toArray();
        $this->provinces = array_unique($provincesAll, SORT_REGULAR);
        $this->cantons = collect();
        $this->validities = Validity::getValidityAll();
    }

    public function incrementSteps()
    {
        if($this->currentStep === 1)
        {
            $this->validateForm();
            $this->currentStep++;
            $this->headerButton = 'light';
            $this->headerText = 'dark';
            $this->headerButton2 = 'primary';
            $this->headerText2 = 'light';
        }
    }

    public function decrementSteps()
    {
        if($this->currentStep === 2)
        {
            $this->currentStep--;
            $this->headerButton = 'primary';
            $this->headerText = 'light';
            $this->headerButton2 = 'light';
            $this->headerText2 = 'dark';
        }
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

    public function updatedProvincia($value)
    {
        $this->cantons = Geography::orderBy('name_canton', 'asc')->select('cod_canton', 'name_canton')->where('cod_province', $value)->get()->toArray();
    }

    public function changeFormat()
    {
        if($this->formato === 'TOKEN')
        {
            $this->displayToken = 'block';
            $this->validities = Validity::getValidityYear();
        }elseif($this->formato === 'COMBO p12+nube'){
            $this->displayToken = 'none';
            $this->validities = Validity::getValidityYear();
        }elseif($this->formato === 'ARCHIVO'){
            $this->displayToken = 'none';
            $this->validities = Validity::getValidityYear();
        }elseif($this->formato === 'EN NUBE'){
            $this->displayToken = 'none';
            $this->validities = Validity::getValidityYear();
        }
    }

    public function validateForm()
    {
        // dd('entro');
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
                // 'con_ruc'           => 'required',
                'provincia'         => 'required',
                'ciudad'            => 'required',
                'direccion'         => 'required',
                'formato'           => 'required',
                'vigenciafirma'     => 'required',
                'token'             => 'nullable|max:50',
                'ruc'               => 'required|numeric|min_digits:13|max_digits:13',
                'empresa'           => 'required',
                'cargo'             => 'required'
            ]);
        }
    }

    public function updatedFAdicional1($value)
    {
        $this->aditional1Extension = $value->getClientOriginalExtension();
    }

    public function updatedFechaNacimiento($value)
    {
        $birth = date('Y', strtotime($value));
        $currentDate = date('Y');
        $remainingDates = $currentDate - $birth;
        if($remainingDates >= 64)
        {
            $this->displayVideo = 'block';
        }else{
            $this->displayVideo = 'none';
        }
    }

    public function saveLegalRepresentative()
    {
        if($this->currentStep === 2)
        {
            $this->validate([
                'f_cedulaFront'     => 'required|image|mimes:jpg,png',
                'f_cedulaBack'      => 'required|image|mimes:jpg,png',
                'f_selfie'          => 'required|image|mimes:jpg,png',
                'videoFile'         => 'nullable|mimetypes:video/avi,video/mpeg,video/quicktime|max:10240',
                'f_copiaruc'        => 'required|nullable|file|mimes:pdf',
                'f_adicional1'      => 'nullable|file|mimes:pdf,jpg,png',
                'f_adicional2'      => 'nullable|file|mimes:pdf',
                'f_adicional3'      => 'nullable|file|mimes:pdf',
                'f_adicional4'      => 'nullable|file|mimes:pdf',
                'f_constitucion'    => 'required|file|mimes:pdf',
                'f_nombramiento'    => 'required|file|mimes:pdf',
                'f_nombramiento2'   => 'nullable|file|mimes:pdf'
            ]);
        }

        $legalRepresentative = new Signature;
        $legalRepresentative->tipo_solicitud = 2;
        $legalRepresentative->nombres = Str::upper($this->nombres); //si
        $legalRepresentative->apellido1 = Str::upper($this->apellido1); //si
        $legalRepresentative->apellido2 = Str::upper($this->apellido2); //si
        $legalRepresentative->tipodocumento = $this->tipodocumento; //si
        $legalRepresentative->numerodocumento = $this->numerodocumento; //si
        $legalRepresentative->ruc_personal = $this->ruc_personal;//si
        $legalRepresentative->sexo = $this->sexo;//si
        $legalRepresentative->fecha_nacimiento = $this->fecha_nacimiento;//si
        $legalRepresentative->nacionalidad = $this->nacionalidad;//si
        $legalRepresentative->cdactilar = Str::upper($this->cdactilar);//si
        $legalRepresentative->telfCelular = $this->telfCelular;//si
        $legalRepresentative->telfCelular2 = $this->telfCelular2;//si
        $legalRepresentative->eMail = $this->eMail;//si
        $legalRepresentative->eMail2 = $this->eMail2;//si
        // $legalRepresentative->con_ruc = $this->con_ruc;//si
        $provinciaText = Geography::select('name_province')->where('cod_province', $this->provincia)->first();
        $ciudadText = Geography::select('name_canton')->where('cod_province', $this->provincia)->where('cod_canton', $this->ciudad)->first();
        $legalRepresentative->provincia = $provinciaText->name_province;//si
        $legalRepresentative->ciudad = $ciudadText->name_canton;//si
        $legalRepresentative->direccion = Str::upper($this->direccion);//si
        $legalRepresentative->formato = $this->formato;//si
        $legalRepresentative->vigenciafirma = $this->vigenciafirma;//si
        $legalRepresentative->token = $this->token;//si
        // Legal Representative
        $legalRepresentative->ruc = $this->ruc; //si
        $legalRepresentative->empresa = $this->empresa; //si
        $legalRepresentative->cargo = $this->cargo; //si
        $legalRepresentative->estado = 'EN VALIDACION';
        $legalRepresentative->user_id = Auth::user()->id;
        $legalRepresentative->save();

        // Convert to Base64
        $f_cedulaFront = ($this->f_cedulaFront) ? base64_encode(file_get_contents($this->f_cedulaFront->getRealPath())) : NULL;
        $f_cedulaBack = ($this->f_cedulaBack) ? base64_encode(file_get_contents($this->f_cedulaBack->getRealPath())) : NULL;
        $f_selfie = ($this->f_selfie) ? base64_encode(file_get_contents($this->f_selfie->getRealPath())) : NULL;
        $videoFile = ($this->videoFile) ? base64_encode(file_get_contents($this->videoFile->getRealPath())) : NULL;
        $f_copiaruc = ($this->f_copiaruc) ? base64_encode(file_get_contents($this->f_copiaruc->getRealPath())) : NULL;
        $f_adicional1 = ($this->f_adicional1) ? base64_encode(file_get_contents($this->f_adicional1->getRealPath())) : NULL;
        // Legal representative
        $f_constitucion = ($this->f_constitucion) ? base64_encode(file_get_contents($this->f_constitucion->getRealPath())) : NULL;
        $f_nombramiento = ($this->f_nombramiento) ? base64_encode(file_get_contents($this->f_nombramiento->getRealPath())) : NULL;
        $f_nombramiento2 = ($this->f_nombramiento2) ? base64_encode(file_get_contents($this->f_nombramiento2->getRealPath())) : NULL;

        $legalRepresentativeFile = new SignatureFile;
        $legalRepresentativeFile->signature_id = $legalRepresentative->id;
        $legalRepresentativeFile->tipo_solicitud = 2;
        $legalRepresentativeFile->f_cedulaFront = $f_cedulaFront;
        $legalRepresentativeFile->f_cedulaBack = $f_cedulaBack;
        $legalRepresentativeFile->f_selfie = $f_selfie;
        $legalRepresentativeFile->videoFile = $videoFile;
        $legalRepresentativeFile->f_copiaruc = $f_copiaruc;
        $legalRepresentativeFile->f_adicional1 = $f_adicional1;
        // Legal representative
        $legalRepresentativeFile->f_constitucion = $f_constitucion;
        $legalRepresentativeFile->f_nombramiento = $f_nombramiento;
        $legalRepresentativeFile->f_nombramiento2 = $f_nombramiento2;
        $legalRepresentativeFile->save();

        return redirect()->route('signatures');
    }
}
