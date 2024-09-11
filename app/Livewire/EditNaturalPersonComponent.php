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
use Livewire\Attributes\Url;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class EditNaturalPersonComponent extends Component
{
    use WithFileUploads;
    #[Url]
    public $id;
    public $headerButton = 'warning', $headerText, $headerButton2 = '', $headerText2 = '', $currentStep = 1, $nationalities, $selectCedula = 'disabled';
    public $numRuc = 'none', $provinces, $cantons = [], $formats, $validities, $displayToken = 'none', $partners, $totalStep = 2, $ruc_personal, $signature;
    public $numerodocumento, $radioCheckedOn, $radioCheckedOff, $provincia, $nombres, $tipodocumento, $apellido1, $apellido2, $fecha_nacimiento, $sexo;
    public $nacionalidad, $cdactilar, $telfCelular, $eMail, $telfCelular2, $eMail2, $con_ruc, $ciudad, $direccion, $formato, $vigenciafirma, $token, $partner;
    public $requiredCodigoDactilar, $requiredRuc, $f_cedulaFront, $f_cedulaBack, $f_selfie, $displayVideo = 'none', $videoFile, $f_copiaruc, $f_adicional2;
    public $f_adicional1, $f_adicional3, $f_adicional4, $signatureFile;
    public $rule_f_cedulaFront = '', $rule_f_cedulaBack = '', $rule_f_selfie = '', $rule_videoFile = '', $rule_f_copiaruc = '', $rule_ff_adicional2 = '';

    public function mount()
    {
        $this->nationalities = Nationalities::getNationalities();
        $provincesAll = Geography::select('name_province', 'cod_province')->get()->toArray();
        $this->provinces = array_unique($provincesAll, SORT_REGULAR);
        $this->cantons = collect();
        $this->formats = Signature::getContainer();
        $this->validities = Validity::getValidityAll();
        $this->partners = Partner::orderBy('name', 'ASC')->get();
        $this->signature = Signature::find($this->id);
        // Values Imputs
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
        ($this->signature->con_ruc === 'SI') ? $this->conRuc() : $this->sinRuc();
        $this->con_ruc = $this->signature->con_ruc;
        $this->ruc_personal = $this->signature->ruc_personal;
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
    }
    public function render()
    {
        return view('livewire.edit-natural-person-component');
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

    public function sinRuc()
    {
        $this->numRuc = 'none';
        $this->ruc_personal = '';
        $this->radioCheckedOn = '';
        $this->radioCheckedOff = 'checked';
    }

    public function conRuc()
    {
        $this->numRuc = 'block';
        $this->ruc_personal = $this->numerodocumento . '001';
        $this->radioCheckedOn = 'checked';
        $this->radioCheckedOff = '';
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
            $this->vigenciafirma = '';
        }elseif($this->formato === '3'){
            $this->displayToken = 'none';
            $this->validities = Validity::getValidityYear();
            $this->vigenciafirma = '';
        }elseif($this->formato === '0'){
            $this->displayToken = 'none';
            $this->validities = Validity::getValidityAll();
            $this->vigenciafirma = '';
        }elseif($this->formato === '2'){
            $this->displayToken = 'none';
            $this->validities = Validity::getValidityAll();
            $this->vigenciafirma = '';
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

    public function validateForm()
    {
        ($this->tipodocumento == 'CEDULA') ? $this->requiredCodigoDactilar = 'required' : $this->requiredCodigoDactilar = '';
        ($this->con_ruc == 'SI') ? $this->requiredRuc = 'required' : $this->requiredRuc = '';
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

    public function saveNaturalPerson()
    {
        (gettype($this->f_cedulaFront) === 'object') ? $this->rule_f_cedulaFront = 'required|image|mimes:jpg,png' : '';
        (gettype($this->f_cedulaBack) === 'object') ? $this->rule_f_cedulaBack = 'required|image|mimes:jpg,png' : '';
        (gettype($this->f_selfie) === 'object') ? $this->rule_f_selfie = 'required|image|mimes:jpg,png' : '';
        (gettype($this->videoFile) === 'object') ? $this->rule_videoFile = 'nullable|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:10240' : '';
        (gettype($this->f_copiaruc) === 'object') ? $this->rule_f_copiaruc = 'required|nullable|file|mimes:pdf' : '';
        (gettype($this->f_adicional2) === 'object') ? $this->rule_ff_adicional2 = 'nullable|file|mimes:pdf,jpg,png' : '';
        if($this->currentStep === 2)
        {
            $this->validate([
                'f_cedulaFront'     => $this->rule_f_cedulaFront,
                'f_cedulaBack'      => $this->rule_f_cedulaBack,
                'f_selfie'          => $this->rule_f_selfie,
                'videoFile'         => $this->rule_videoFile,
                'f_copiaruc'        => $this->rule_f_copiaruc,
                'f_adicional1'      => 'nullable|file|mimes:pdf,jpg,png',
                'f_adicional2'      => $this->rule_ff_adicional2,
                'f_adicional3'      => 'nullable|file|mimes:pdf',
                'f_adicional4'      => 'nullable|file|mimes:pdf',
            ]);
        }
        $naturalPerson = Signature::find($this->id);
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
        $naturalPerson->estado = 'ACTUALIZADO';
        $naturalPerson->user_id = Auth::user()->id;
        $naturalPerson->save();

        // Convert to Base64
        $f_cedulaFront = (gettype($this->f_cedulaFront) === 'object') ? base64_encode(file_get_contents($this->f_cedulaFront->getRealPath())) : $this->f_cedulaFront;
        $f_cedulaBack = (gettype($this->f_cedulaBack) === 'object') ? base64_encode(file_get_contents($this->f_cedulaBack->getRealPath())) : $this->f_cedulaBack;
        $f_selfie = (gettype($this->f_selfie) === 'object') ? base64_encode(file_get_contents($this->f_selfie->getRealPath())) : $this->f_selfie;
        $videoFile = (gettype($this->videoFile) === 'object') ? base64_encode(file_get_contents($this->videoFile->getRealPath())) : $this->videoFile;
        $f_copiaruc = (gettype($this->f_copiaruc) === 'object') ? base64_encode(file_get_contents($this->f_copiaruc->getRealPath())) : $this->f_copiaruc;
        $f_adicional2 = (gettype($this->f_adicional2) === 'object') ? base64_encode(file_get_contents($this->f_adicional2->getRealPath())) : $this->f_adicional2;
        
        $naturalPersonFile = SignatureFile::where('signature_id', $naturalPerson->id)->first();
        $naturalPersonFile->f_cedulaFront = $f_cedulaFront;
        $naturalPersonFile->f_cedulaBack = $f_cedulaBack;
        $naturalPersonFile->f_selfie = $f_selfie;
        $naturalPersonFile->videoFile = $videoFile;
        $naturalPersonFile->f_copiaruc = $f_copiaruc;
        $naturalPersonFile->f_adicional2 = $f_adicional2;
        $naturalPersonFile->save();
        // Data for Consolidation
        $consolidation = Consolidation::where('signature_id', $naturalPerson->id)->first();
        $consolidation->partner_id = $this->partner;
        $consolidation->save();
        
        return redirect()->route('signatures');
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
}
