<?php

namespace App\Livewire;

use App\Models\Consolidation;
use App\Models\Geography;
use App\Models\Nationalities;
use App\Models\Partner;
use App\Models\Price;
use App\Models\Signature;
use App\Models\SignatureFile;
use App\Models\Validity;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CompanyMemberComponent extends Component
{
    use WithFileUploads;

    public $headerButton = 'primary', $headerText = 'light', $headerButton2 = '', $headerText2 = '', $currentStep = 1, $nationalities;
    public $selectCedula = 'disabled', $provinces, $cantons = [], $validities, $displayToken = 'none', $totalStep = 2;
    public $tipo_solicitud, $contenedor, $nombres, $apellido1, $apellido2, $tipodocumento, $numerodocumento, $ruc_personal, $con_ruc;
    public $sexo, $fecha_nacimiento, $nacionalidad = 'ECUATORIANA', $telfCelular, $telfFijo, $eMail, $provincia, $ciudad, $direccion, $vigenciafirma;
    public $f_cedulaFront, $f_cedulaBack, $f_selfie, $f_copiaruc, $f_adicional1, $f_adicional2, $f_adicional3, $f_adicional4;
    public $requiredCodigoDactilar, $cdactilar, $telfCelular2, $eMail2, $formato, $token, $ruc, $empresa, $cargo, $unidad, $tipodocumentoRL;
    public $numerodocumentoRL, $nombresRL, $apellido1RL, $apellido2RL, $displayVideo = 'none', $videoFile, $f_constitucion, $f_nombramiento;
    public $f_nombramiento2, $f_documentoRL, $f_autreprelegal, $aditional1Extension, $partners, $partner, $formats;
    public function render()
    {
        return view('livewire.company-member-component');
    }

    public function mount()
    {
        $this->nationalities = Nationalities::getNationalities();
        $provincesAll = Geography::select('name_province', 'cod_province')->get()->toArray();
        $this->provinces = array_unique($provincesAll, SORT_REGULAR);
        $this->cantons = collect();
        $this->validities = Validity::getValidityAll();
        $this->partners = Partner::orderBy('name', 'ASC')->get();
        $this->formats = Signature::getContainer();
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

    public function updatedProvincia($value)
    {
        $this->cantons = Geography::orderBy('name_canton', 'asc')->select('cod_canton', 'name_canton')->where('cod_province', $value)->get()->toArray();
    }

    public function changeFormat()
    {
        if($this->formato === '1')
        {
            $this->displayToken = 'block';
            $this->validities = Validity::getValidityYear();
        }elseif($this->formato === '3'){
            $this->displayToken = 'none';
            $this->validities = Validity::getValidityYear();
        }elseif($this->formato === '0'){
            $this->displayToken = 'none';
            $this->validities = Validity::getValidityYear();
        }elseif($this->formato === '2'){
            $this->displayToken = 'none';
            $this->validities = Validity::getValidityYear();
        }
    }
    public function saveCompanyMember()
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
                'f_nombramiento2'   => 'nullable|file|mimes:pdf',
                'f_documentoRL'     => 'required|file|mimes:pdf',
                'f_autreprelegal'   => 'required|file|mimes:pdf'
            ]);

            $companyMember = new Signature;
            $companyMember->creacion = date('Y-m-d h:i:s');
            $companyMember->tipo_solicitud = 3;
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
            $companyMember->estado = 'SIN ENVIAR';
            $companyMember->user_id = Auth::user()->id;

            $companyMember->save();

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
            // company member
            $f_documentoRL = ($this->f_documentoRL) ? base64_encode(file_get_contents($this->f_documentoRL->getRealPath())) : NULL;
            $f_autreprelegal = ($this->f_autreprelegal) ? base64_encode(file_get_contents($this->f_autreprelegal->getRealPath())) : NULL;

            $companyMemberFile = new SignatureFile;
            $companyMemberFile->signature_id = $companyMember->id;
            $companyMemberFile->tipo_solicitud = 3;
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
            $consolidation = new Consolidation;
            $consolidation->creacion_signature = $companyMember->creacion;
            $consolidation->signature_id = $companyMember->id;
            $consolidation->partner_id = $this->partner;
            $consolidation->consolidado_banco = 'PENDIENTE';
            $consolidation->estado_pago = 'PENDIENTE';
            $consolidation->penalidad = 0;
            // Price Signature
            $price_signature = Price::getPriceSignature($companyMember->vigenciafirma, $this->partner);
            // Price Uanataca
            $price_uanataca = Price::getPriceUanataca($companyMember->vigenciafirma);
            $consolidation->monto_pagado = $price_signature->amount;
            $consolidation->monto_uanataca = $price_uanataca->amount;
            $consolidation->save();
            
            return redirect()->route('signatures');
        }

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

    public function updatedFAdicional1($value)
    {
        $this->aditional1Extension = $value->getClientOriginalExtension();
    }
}
