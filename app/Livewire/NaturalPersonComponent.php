<?php

namespace App\Livewire;

use App\Imports\SignatureImport;
use App\Models\Consolidation;
use App\Models\Geography;
use App\Models\Nationalities;
use App\Models\NaturalPerson;
use App\Models\NaturalPersonFile;
use App\Models\Partner;
use App\Models\Price;
use App\Models\Signature;
use App\Models\SignatureFile;
use App\Models\Validity;
use Illuminate\Support\Facades\Auth;
// use DragonCode\Contracts\Cashier\Auth\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class NaturalPersonComponent extends Component
{
    use WithFileUploads;

    public $tipo_solicitud, $contenedor, $nombres, $apellido1, $apellido2, $tipodocumento, $numerodocumento, $ruc_personal, $con_ruc;
    public $sexo, $fecha_nacimiento, $nacionalidad = 'ECUATORIANA', $telfCelular, $telfFijo, $eMail, $provincia, $ciudad, $direccion, $vigenciafirma;
    public $f_cedulaFront, $f_cedulaBack, $f_selfie, $f_copiaruc, $f_adicional1, $f_adicional2, $f_adicional3, $f_adicional4;
    public $cdactilar, $telfCelular2, $eMail2, $ConRuc, $formato, $selectCedula = 'disabled', $numRuc = 'none', $requiredCodigoDactilar;
    public $provinces, $cantons = [], $token, $displayToken = 'none', $validities, $nationalities, $displayVideo = 'none', $headerButton = 'primary', $headerText = 'light';
    public $headerButton2 = '', $headerText2 = '', $aditional1Extension, $partners, $partner, $formats, $videoFile;
    // public $videoFile;
    public $requiredRuc;
    public $currentStep = 1;
    public $totalStep = 2;
    public $image;

    // public $id=1;

    public function mount()
    {
        $provincesAll = Geography::select('name_province', 'cod_province')->get()->toArray();
        $this->provinces = array_unique($provincesAll, SORT_REGULAR);
        $this->cantons = collect();
        $this->validities = Validity::getValidityAll();
        $this->nationalities = Nationalities::getNationalities();
        $this->partners = Partner::orderBy('name', 'ASC')->get();
        $this->formats = Signature::getContainer();
    }

    public function render()
    {
        return view('livewire.natural-person-component', [
        ]);
    }

    public function updatedProvincia($value)
    {
        $this->cantons = Geography::orderBy('name_canton', 'asc')->select('cod_canton', 'name_canton')->where('cod_province', $value)->get()->toArray();
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
            $this->validities = Validity::getValidityAll();
        }elseif($this->formato === '2'){
            $this->displayToken = 'none';
            $this->validities = Validity::getValidityAll();
        }
    }

    public function validateForm()
    {
        ($this->tipodocumento == 'CEDULA') ? $this->requiredCodigoDactilar = 'required' : $this->requiredCodigoDactilar = '';
        ($this->con_ruc == 'SI') ? $this->requiredRuc = 'required' : $this->requiredRuc = '';
        // dd($this->partner);
        if($this->currentStep === 1)
        {
            $this->validate([
                'nombres'           => 'required',
                'apellido1'         => 'required',
                'apellido2'         => 'nullable',
                'tipodocumento'     => 'required',
                'numerodocumento'   => 'required|min:5|max:20',
                'ruc_personal'      => $this->requiredRuc . '|nullable|numeric|min_digits:13|max_digits:13', //13
                'sexo'              => 'required',
                'fecha_nacimiento'  => 'required|date',
                'nacionalidad'      => 'required',
                'cdactilar'         => $this->requiredCodigoDactilar . '|min:6|max:10|nullable',
                'telfCelular'       => 'required|numeric|min_digits:10|max_digits:10',
                'telfCelular2'      => 'numeric|nullable|min_digits:10|max_digits:10',
                'eMail'             => 'required|email',
                'eMail2'            => 'nullable|email',
                'con_ruc'           => 'required',
                'provincia'         => 'required',
                'ciudad'            => 'required',
                'direccion'         => 'required',
                'formato'           => 'required',
                'vigenciafirma'     => 'required',
                'token'             => 'nullable|max:50',
                'partner'           => 'required'
            ]);
        }
        
    }

    public function saveNaturalPerson()
    {
        // $algo = Price::getPriceSignature(1, $this->partner);
        // $algo1 = Price::getPriceUanataca(1);
        // dd($algo);
        ($this->con_ruc == 'SI') ? $this->requiredRuc = 'required' : $this->requiredRuc = '';
        if($this->currentStep === 2)
        {
            $this->validate([
                'f_cedulaFront'     => 'required|image|mimes:jpg,png',
                'f_cedulaBack'      => 'required|image|mimes:jpg,png',
                'f_selfie'          => 'required|image|mimes:jpg,png',
                'videoFile'         => 'nullable|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:10240',
                'f_copiaruc'        => $this->requiredRuc . '|nullable|file|mimes:pdf',
                'f_adicional1'      => 'nullable|file|mimes:pdf,jpg,png',
                'f_adicional2'      => 'nullable|file|mimes:pdf',
                'f_adicional3'      => 'nullable|file|mimes:pdf',
                'f_adicional4'      => 'nullable|file|mimes:pdf',
            ]);
        }
        
        $naturalPerson = new Signature;
        $naturalPerson->creacion = date('Y-m-d h:i:s');
        $naturalPerson->tipo_solicitud = 1;
        $naturalPerson->nombres = Str::upper($this->nombres); //si
        $naturalPerson->apellido1 = Str::upper($this->apellido1); //si
        $naturalPerson->apellido2 = Str::upper($this->apellido2); //si
        $naturalPerson->tipodocumento = $this->tipodocumento; //si
        $naturalPerson->numerodocumento = $this->numerodocumento; //si
        $naturalPerson->ruc_personal = $this->ruc_personal;//si
        $naturalPerson->sexo = $this->sexo;//si
        $naturalPerson->fecha_nacimiento = $this->fecha_nacimiento;//si
        $naturalPerson->nacionalidad = $this->nacionalidad;//si
        $naturalPerson->cdactilar = Str::upper($this->cdactilar);//si
        $naturalPerson->telfCelular = $this->telfCelular;//si
        $naturalPerson->telfCelular2 = $this->telfCelular2;//si
        $naturalPerson->eMail = $this->eMail;//si
        $naturalPerson->eMail2 = $this->eMail2;//si
        $naturalPerson->con_ruc = $this->con_ruc;//si
        $provinciaText = Geography::select('name_province')->where('cod_province', $this->provincia)->first();
        $ciudadText = Geography::select('name_canton')->where('cod_province', $this->provincia)->where('cod_canton', $this->ciudad)->first();
        $naturalPerson->provincia = $provinciaText->name_province;//si
        $naturalPerson->ciudad = $ciudadText->name_canton;//si
        $naturalPerson->direccion = Str::upper($this->direccion);//si
        $naturalPerson->formato = $this->formato;//si
        $naturalPerson->vigenciafirma = $this->vigenciafirma;//si
        $naturalPerson->token = $this->token;//si
        $naturalPerson->estado = 'SIN ENVIAR';
        $naturalPerson->user_id = Auth::user()->id;
        $naturalPerson->save();

        // Convert to Base64
        $f_cedulaFront = ($this->f_cedulaFront) ? base64_encode(file_get_contents($this->f_cedulaFront->getRealPath())) : NULL;
        $f_cedulaBack = ($this->f_cedulaBack) ? base64_encode(file_get_contents($this->f_cedulaBack->getRealPath())) : NULL;
        $f_selfie = ($this->f_selfie) ? base64_encode(file_get_contents($this->f_selfie->getRealPath())) : NULL;
        $videoFile = ($this->videoFile) ? base64_encode(file_get_contents($this->videoFile->getRealPath())) : NULL;
        $f_copiaruc = ($this->f_copiaruc) ? base64_encode(file_get_contents($this->f_copiaruc->getRealPath())) : NULL;
        $f_adicional1 = ($this->f_adicional1) ? base64_encode(file_get_contents($this->f_adicional1->getRealPath())) : NULL;
        
        $naturalPersonFile = new SignatureFile;
        $naturalPersonFile->signature_id = $naturalPerson->id;
        $naturalPersonFile->tipo_solicitud = 1;
        $naturalPersonFile->f_cedulaFront = $f_cedulaFront;
        $naturalPersonFile->f_cedulaBack = $f_cedulaBack;
        $naturalPersonFile->f_selfie = $f_selfie;
        $naturalPersonFile->videoFile = $videoFile;
        $naturalPersonFile->f_copiaruc = $f_copiaruc;
        $naturalPersonFile->f_adicional1 = $f_adicional1;
        $naturalPersonFile->save();
        // dd($naturalPersonFile);
        // Data for Consolidation
        $consolidation = new Consolidation;
        $consolidation->creacion_signature = $naturalPerson->creacion;
        $consolidation->signature_id = $naturalPerson->id;
        $consolidation->partner_id = $this->partner;
        $consolidation->consolidado_banco = 'PENDIENTE';
        $consolidation->estado_pago = 'PENDIENTE';
        $consolidation->penalidad = 0;
        // Price Signature
        $price_signature = Price::getPriceSignature($naturalPerson->vigenciafirma, $this->partner);
        // Price Uanataca
        $price_uanataca = Price::getPriceUanataca($naturalPerson->vigenciafirma);
        $consolidation->monto_pagado = $price_signature->amount;
        $consolidation->monto_uanataca = $price_uanataca->amount;
        $consolidation->save();
        
        return redirect()->route('signatures');
    }

    public function sinRuc()
    {
        $this->numRuc = 'none';
        $this->ruc_personal = '';
    }

    public function conRuc()
    {
        $this->numRuc = 'block';
        $this->ruc_personal = $this->numerodocumento . '001';
    }
}
