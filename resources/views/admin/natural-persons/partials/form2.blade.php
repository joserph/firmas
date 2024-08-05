<div class="row">
   <div class="col-sm-4">
      <div class="pictureContainer">
         <h6 class="text-center"><span class="text-danger">*</span> Foto del lado frontal de su cédula</h6>
         <div class="picture" class="text-center">
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" @if ($f_cedulaFront)
               src="{{ $f_cedulaFront->temporaryUrl() }}"
            @else
               src="{{ asset('assets/images/others/front.png') }}"
            @endif  alt="">
            <input class="inputImage" type="file" accept=".jpg,.jpeg,.png" wire:model="f_cedulaFront">
         </div>
         @error('f_cedulaFront')
            <span class="text-danger">{{$message}}</span>
         @enderror
      </div>
   </div>
   <div class="col-sm-4">
      <div class="pictureContainer">
         <h6 class="text-center"><span class="text-danger">*</span> Foto del lado posterior de su cédula</h6>
         <div class="picture" class="text-center">
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" @if ($f_cedulaBack)
               src="{{ $f_cedulaBack->temporaryUrl() }}"
            @else
               src="{{ asset('assets/images/others/back.png') }}"
            @endif  alt="">
            <input class="inputImage" type="file" accept=".jpg,.jpeg,.png" wire:model="f_cedulaBack">
         </div>
         @error('f_cedulaBack')
            <span class="text-danger">{{$message}}</span>
         @enderror
      </div>
   </div>
   <div class="col-sm-4">
      <div class="pictureContainer">
         <h6 class="text-center"><span class="text-danger">*</span> Foto Selfie con su cédula</h6>
         <div class="picture" class="text-center">
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" @if ($f_selfie)
               src="{{ $f_selfie->temporaryUrl() }}"
            @else
               src="{{ asset('assets/images/others/selfie.png') }}"
            @endif  alt="">
            <input class="inputImage" type="file" accept=".jpg,.jpeg,.png" wire:model="f_selfie">
         </div>
         @error('f_selfie')
            <span class="text-danger">{{$message}}</span>
         @enderror
      </div>
   </div>
   <br>
   <hr>
   <br>
   <div class="col-sm-4" style="display: {{ $displayVideo }}">
      <div class="pictureContainer">
         <h6 class="text-center"><span class="text-danger">*</span> Video</h6>
         <div class="picture" class="text-center">
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" @if ($videoFile)
               src="{{ asset('assets/images/others/video2.png') }}"
            @else
               src="{{ asset('assets/images/others/video.png') }}"
            @endif  alt="">
            <input class="inputImage" type="file" wire:model="videoFile"  >
         </div>
         @error('video')
            <span class="text-danger">{{$message}}</span>
         @enderror
      </div>
   </div>
   <div class="col-sm-4" style="display: {{ $numRuc }}">
      <div class="pictureContainer">
         <h6 class="text-center"><span class="text-danger">*</span> Copia del RUC</h6>
         <div class="picture" class="text-center">
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" @if ($f_copiaruc)
               src="{{ asset('assets/images/others/pdf_on.jpg') }}"
            @else
               src="{{ asset('assets/images/others/ruc.jpg') }}"
            @endif  alt="">
            <input class="inputImage" type="file" accept=".pdf" wire:model="f_copiaruc">
         </div>
         @error('f_copiaruc')
            <span class="text-danger">{{$message}}</span>
         @enderror
      </div>
   </div>
   <div class="col-sm-4">
      <div class="pictureContainer">
         <h6 class="text-center">Documento Adicional 1</h6>
         <div class="picture" class="text-center">
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" @if ($f_adicional1)
               @if ($aditional1Extension === 'pdf')
                  src="{{ asset('assets/images/others/pdf_on.jpg') }}"
               @else
                  src="{{ $f_adicional1->temporaryUrl() }}"
               @endif
            @else
               src="{{ asset('assets/images/others/adicional.jpg') }}"
            @endif  alt="">
            <input class="inputImage" type="file" accept=".pdf,.jpg,.jpeg,.png" wire:model="f_adicional1">
         </div>
         @error('f_adicional1')
            <span class="text-danger">{{$message}}</span>
         @enderror
      </div>
   </div>
</div>