<div class="row">
   <div class="col-sm-3">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Tipo de Documento</label>
         <select class="form-select text-uppercase mb-2" wire:model="tipodocumento" id="tipodocumento" onfocusout="validar_Cedula(numerodocument)" wire:change="changeTypeDocument" autofocus="true" data-autofocus required>
            <option value="" selected="">Seleccione Documento</option>
            <option value="CEDULA">CEDULA</option>
            <option value="PASAPORTE">PASAPORTE</option>
         </select>
         @error('tipodocumento')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div>
   <div class="col-sm-3">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Nro. de Documento</label>
         <input type="text" class="form-control text-uppercase mb-2" minlength="5" maxlength="20" onfocusout="validar_Cedula(this)" id="numerodocumento" wire:model="numerodocumento" placeholder="17120083..." required>
         @error('numerodocumento')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div><!-- Col -->
   <div class="col-sm-4">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Nombres</label>
         <input type="text" class="form-control text-uppercase mb-2" wire:model="nombres" placeholder="Juan Carlos..." required>
         @error('nombres')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div><!-- Col -->
   
</div><!-- Row -->
<div class="row">
    <div class="col-sm-3">
       <div class="form-group">
          <label class="control-label"><span class="text-danger">*</span> 1er Apellido</label>
          <input type="text" class="form-control text-uppercase mb-2" wire:model="apellido1" placeholder="Apellido 1" required>
          @error('apellido1')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
       </div>
    </div><!-- Col -->
    <div class="col-sm-3">
       <div class="form-group">
          <label class="control-label">2do Apellido</label>
          <input type="text" class="form-control text-uppercase mb-2" wire:model="apellido2" placeholder="Apellido 2" required>
          @error('apellido2')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
       </div>
    </div><!-- Col -->
    <div class="col-sm-3">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Fecha Nacimiento</label>
         <input type="date" class="form-control mb-2" wire:model.blur="fecha_nacimiento" required>
         @error('fecha_nacimiento')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div><!-- Col -->
   <div class="col-sm-3">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Sexo</label>
         <select class="form-select mb-2" wire:model="sexo" required>
            <option selected="">Seleccione sexo</option>
            <option value="HOMBRE">HOMBRE</option>
            <option value="MUJER">MUJER</option>
         </select>
         @error('sexo')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div><!-- Col -->
</div><!-- Row -->

<div class="row">
   
   <div class="col-sm-4">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Nacionalidad</label>
         <select class="form-select mb-2" wire:model="nacionalidad" required>
            {{-- <option value="">Seleccione Documento</option> --}}
            <option value="ECUATORIANA" selected>ECUATORIANA</option>
            @foreach ($nationalities as $item)
                <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
         </select>
         @error('nacionalidad')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div><!-- Col -->
   
   <div class="col-sm-3">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Código Dactilar</label>
         <input type="text" class="form-control text-uppercase mb-2" minlength="6" maxlength="10" {{ $selectCedula }} wire:model="cdactilar" placeholder="ExxxxIxxxx">
         @error('cdactilar')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div><!-- Col -->
   
   <div class="col-sm-3">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Celular</label>
         <input type="text" class="form-control mb-2" minlength="10" maxlength="10" wire:model="telfCelular" placeholder="0912345678" required>
         @error('telfCelular')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div><!-- Col -->
 </div><!-- Row -->
 <div class="row">
   
   <div class="col-sm-4">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Email</label>
         <input type="email" class="form-control mb-2" wire:model="eMail" placeholder="sucorreo@hotmail.com" required>
         @error('eMail')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div><!-- Col -->
   <div class="col-sm-3">
      <div class="form-group">
         <label class="control-label">Celular 2</label>
         <input type="text" class="form-control mb-2" wire:model="telfCelular2" minlength="10" maxlength="10" placeholder="0912345678">
         @error('telfCelular2')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div><!-- Col -->
   <div class="col-sm-4">
      <div class="form-group">
         <label class="control-label">Email 2</label>
         <input type="email" class="form-control mb-2" wire:model="eMail2" placeholder="sucorreo@empresa.com">
         @error('eMail2')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div><!-- Col -->
</div>
<hr>
<div class="row">
   <div class="col-sm-12">
      <div class="lead">Datos de la Empresa</div>
   </div>
   <div class="col-sm-3">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Nro. de RUC</label>
         <input type="text" class="form-control mb-2" minlength="13" maxlength="13" wire:model="ruc" placeholder="17120083...001">
         @error('ruc')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div>
   <div class="col-sm-6">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Razón Social</label>
         <input type="text" class="form-control text-uppercase mb-2" wire:model="empresa" placeholder="RAZON SOCIAL...">
         @error('empresa')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div>
   <div class="col-sm-3">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Area</label>
         <input type="text" class="form-control text-uppercase mb-2" wire:model="unidad" placeholder="CONTABILIDAD...">
         @error('unidad')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div>   
   <div class="col-sm-3">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Cargo del solicitante</label>
         <input type="text" class="form-control text-uppercase mb-2" wire:model="cargo" placeholder="CONTADOR...">
         @error('cargo')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div> 
</div>
<hr>
<div class="row">
   <div class="col-sm-12">
      <div class="lead">Representante Legal</div>
   </div>
</div>
<div class="row">
   <div class="col-sm-3">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Tipo de Documento</label>
         <select class="form-select text-uppercase mb-2" wire:model="tipodocumentoRL" id="tipodocumentoRL" required>
            <option value="" selected="">Seleccione Documento</option>
            <option value="CEDULA">CEDULA</option>
            <option value="PASAPORTE">PASAPORTE</option>
         </select>
         @error('tipodocumentoRL')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div>
   <div class="col-sm-3">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Nro. de Documento</label>
         <input type="text" class="form-control text-uppercase mb-2" minlength="5" maxlength="20" onfocusout="validar_Cedula(this)" id="numerodocumentoRL" wire:model="numerodocumentoRL" placeholder="17120083..." required>
         @error('numerodocumentoRL')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div> 
   <div class="col-sm-5">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Nombres</label>
         <input type="text" class="form-control text-uppercase mb-2" id="nombresRL" wire:model="nombresRL" placeholder="Ana María..." required>
         @error('nombresRL')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div>
   <div class="col-sm-3">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> 1er Apellido</label>
         <input type="text" class="form-control text-uppercase mb-2" id="apellido1RL" wire:model="apellido1RL" placeholder="SAENZ" required>
         @error('apellido1RL')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div>
   <div class="col-sm-3">
      <div class="form-group">
         <label class="control-label">2do Apellido</label>
         <input type="text" class="form-control text-uppercase mb-2" id="apellido2RL" wire:model="apellido2RL" placeholder="MIÑO">
         @error('apellido2RL')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div>
</div>
<hr>
<div class="row">
   <div class="col-sm-12">
      <div class="lead">Dirección de la empresa <small>(especificada en el ruc)</small></div>
   </div>
</div>
<div class="row">
   <div class="col-sm-3">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Provincia</label>
         {{-- {!! Form::select('provincia', $provinces, null, ['class' => 'form-select mb-2', 'required', 'wire:model.live' => 'provincia', 'placeholder' => 'Seleccione provincia']) !!} --}}
         <select name="" id="" class="form-select mb-2" wire:model.live="provincia" required>
            <option value="">Seleccione Provincia</option>
            @foreach ($provinces as $item)
            <option value="{{ $item['cod_province'] }}">{{ $item['name_province'] }}</option>
            @endforeach
         </select>
         {{-- <input type="text" class="form-control mb-2" wire:model="provincia" placeholder="sucorreo@empresa.com" required> --}}
         @error('provincia')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div><!-- Col -->
   <div class="col-sm-3">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Ciudad</label>
         <select name="ciudad" class="form-select mb-2" id="" required wire:model="ciudad">
            <option value="">Seleccionar</option>
            @foreach ($cantons as $item)
            <option value="{{ $item['cod_canton'] }}">{{ $item['name_canton'] }}</option>
            @endforeach
         </select>
         {{-- <input type="text" class="form-control mb-2" wire:model="ciudad" placeholder="sucorreo@empresa.com" required> --}}
         @error('ciudad')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div><!-- Col -->
   <div class="col-sm-6">
      <div class="form-group">
         <label class="control-label"><span class="text-danger">*</span> Dirección completa, tal como consta en su RUC</label>
         <input type="text" class="form-control text-uppercase mb-2" wire:model="direccion" placeholder="CALLE PRINCIPAL OE4-32 Y CALLE SECUNDARIA" required>
         @error('direccion')
            <span class="text-danger"><small>{{ $message }}</small></span>
         @enderror
      </div>
   </div><!-- Col -->
   <div class="row">
      <div class="col-sm-12">
         <div class="lead">Formato y tiempo de vigencia</div>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-4">
         <div class="form-group">
            <label class="control-label"><span class="text-danger">*</span> En Formato</label>
            <select class="form-select mb-2" wire:model="formato" wire:change='changeFormat' required>
               <option selected="">Seleccione formato</option>
               <option value="EN NUBE">FIRMA EN LA NUBE</option>
               <option value="ARCHIVO">ARCHIVO .P12</option>
               <option value="COMBO p12+nube">COMBO P12+NUBE</option>
               <option value="TOKEN">UANA-TOKEN</option>
            </select>
            @error('formato')
               <span class="text-danger"><small>{{ $message }}</small></span>
            @enderror
         </div>
      </div><!-- Col -->
      <div class="col-sm-4">
         <div class="form-group">
            <label class="control-label"><span class="text-danger">*</span> Tiempo de Vigencia</label>
            <select class="form-select mb-2" wire:model="vigenciafirma" required>
               <option selected="">Seleccione vigencia</option>
               @foreach ($validities as $item)
               <option value="{{ $item }}">{{ $item }}</option>
               @endforeach
            </select>
            @error('vigenciafirma')
               <span class="text-danger"><small>{{ $message }}</small></span>
            @enderror
         </div>
      </div><!-- Col -->
      <div class="col-sm-4" style="display: {{ $displayToken }}">
         <div class="form-group">
            <label class="control-label">Nro. Serial del Token</label>
            <input type="text" class="form-control mb-2" wire:model="token" maxlength="50" placeholder="Nro. Serial del Token" required>
         </div>
      </div>
   </div>
</div>


 