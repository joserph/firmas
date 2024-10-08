<div class="row">
   <div class="col-sm-4">
      <div class="pictureContainer">
         <h6 class="text-center"><span class="text-danger">*</span> Foto del lado frontal de su cédula</h6>
         <div class="picture" class="text-center">
            <div id="visor_f_cedulaFront" wire:ignore></div>
            @if ($f_cedulaFront)
            <img id="img_f_cedulaFront" src="data:image/jpg;base64,{{ $f_cedulaFront }}" width="180"  alt="">
            @else
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" src="{{ asset('assets/images/others/front.png') }}" alt="">
            @endif
            <input class="inputImage" type="file" accept=".jpg,.jpeg,.png" id="f_cedulaFront" wire:model="f_cedulaFront" onchange="validateInputFilePhoto('f_cedulaFront')">
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
            <div id="visor_f_cedulaBack" wire:ignore></div>
            @if ($f_cedulaBack)
            <img id="img_f_cedulaFront" src="data:image/jpg;base64,{{ $f_cedulaBack }}" width="180"  alt="">
            @else
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" src="{{ asset('assets/images/others/back.png') }}" alt="">
            @endif
            <input class="inputImage" type="file" accept=".jpg,.jpeg,.png" id="f_cedulaBack" wire:model="f_cedulaBack" onchange="validateInputFilePhoto('f_cedulaBack')">
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
            <div id="visor_f_selfie" wire:ignore></div>
            @if ($f_selfie)
            <img id="img_f_cedulaFront" src="data:image/jpg;base64,{{ $f_selfie }}" width="180"  alt="">
            @else
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" src="{{ asset('assets/images/others/selfie.png') }}" alt="">
            @endif
            <input class="inputImage" type="file" accept=".jpg,.jpeg,.png" id="f_selfie" wire:model="f_selfie" onchange="validateInputFilePhoto('f_selfie')">
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
            <div id="visor_videoFile" wire:ignore></div>
            @if ($videoFile)
            <video width="180" controls>
               <source id="mp4_videoFile" src='data:video/mp4;base64,{{ $videoFile }}' width='100%' type='video/mp4'>
            </video>
            @else
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" src="{{ asset('assets/images/others/video2.png') }}" alt="">
            @endif
            <input class="inputImage" type="file" wire:model="videoFile" accept=".mp4" id="videoFile" onchange="validateInputFileMp4('videoFile')">
         </div>
         @error('video')
            <span class="text-danger">{{$message}}</span>
         @enderror
      </div>
   </div>
   <div class="col-sm-4">
      <div class="pictureContainer">
         <h6 class="text-center"><span class="text-danger">*</span> Copia del RUC</h6>
         <div class="picture" class="text-center">
            <div id="visor_f_copiaruc" wire:ignore></div>
            @if ($f_copiaruc)
            <embed id="pdf_f_copiaruc" src='data:application/pdf;base64,{{ $f_copiaruc }}' width='100%' height="215px" type='application/pdf'>
            @else
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" src="{{ asset('assets/images/others/ruc.jpg') }}" alt="">
            @endif
            <input class="inputImage" type="file" id="f_copiaruc" accept=".pdf" wire:model="f_copiaruc" onchange="validateInputFilePdf('f_copiaruc')">
         </div>
         @error('f_copiaruc')
            <span class="text-danger">{{$message}}</span>
         @enderror
      </div>
   </div>
   <div class="col-sm-4">
      <div class="pictureContainer">
         <h6 class="text-center"><span class="text-danger">*</span> Constitucion de Compañia</h6>
         <div class="picture" class="text-center">
            <div id="visor_f_constitucion" wire:ignore></div>
            @if ($f_constitucion)
            <embed id="pdf_f_constitucion" src='data:application/pdf;base64,{{ $f_constitucion }}' width='100%' height="215px" type='application/pdf'>
            @else
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" src="{{ asset('assets/images/others/constitution.jpg') }}" alt="">
            @endif
            <input class="inputImage" type="file" accept=".pdf" id="f_constitucion" wire:model="f_constitucion" onchange="validateInputFilePdf('f_constitucion')">
         </div>
         @error('f_constitucion')
            <span class="text-danger">{{$message}}</span>
         @enderror
      </div>
   </div>
   <div class="col-sm-4">
      <div class="pictureContainer">
         <h6 class="text-center"><span class="text-danger">*</span> Nombramiento de Representante</h6>
         <div class="picture" class="text-center">
            <div id="visor_f_nombramiento" wire:ignore></div>
            @if ($f_nombramiento)
            <embed id="pdf_f_nombramiento" src='data:application/pdf;base64,{{ $f_nombramiento }}' width='100%' height="215px" type='application/pdf'>
            @else
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" src="{{ asset('assets/images/others/constitution.jpg') }}" alt="">
            @endif
            <input class="inputImage" type="file" accept=".pdf" id="f_nombramiento" wire:model="f_nombramiento" onchange="validateInputFilePdf('f_nombramiento')">
         </div>
         @error('f_nombramiento')
            <span class="text-danger">{{$message}}</span>
         @enderror
      </div>
   </div>
   <hr>
   <div class="col-sm-4">
      <div class="pictureContainer">
         <h6 class="text-center">Aceptacion de Nombramiento</h6>
         <div class="picture" class="text-center">
            <div id="visor_f_nombramiento2" wire:ignore></div>
            @if ($f_nombramiento2)
            <embed id="pdf_f_nombramiento2" src='data:application/pdf;base64,{{ $f_nombramiento2 }}' width='100%' height="215px" type='application/pdf'>
            @else
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" src="{{ asset('assets/images/others/adicional.jpg') }}" alt="">
            @endif
            <input class="inputImage" type="file" accept=".pdf" id="f_nombramiento2" wire:model="f_nombramiento2" onchange="validateInputFilePdf('f_nombramiento2')">
         </div>
         @error('f_nombramiento2')
            <span class="text-danger">{{$message}}</span>
         @enderror
      </div>
   </div>
   <div class="col-sm-4">
      <div class="pictureContainer">
         <h6 class="text-center">Cedula Representante Legal</h6>
         <div class="picture" class="text-center">
            <div id="visor_f_documentoRL" wire:ignore></div>
            @if ($f_documentoRL)
            <embed id="pdf_f_documentoRL" src='data:application/pdf;base64,{{ $f_documentoRL }}' width='100%' height="215px" type='application/pdf'>
            @else
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" src="{{ asset('assets/images/others/ci_rl.jpg') }}" alt="">
            @endif
            <input class="inputImage" type="file" accept=".pdf" id="f_documentoRL" wire:model="f_documentoRL" required onchange="validateInputFilePdf('f_documentoRL')">
         </div>
         @error('f_documentoRL')
            <span class="text-danger">{{$message}}</span>
         @enderror
      </div>
   </div>
   <div class="col-sm-4">
      <div class="pictureContainer">
         <h6 class="text-center">Autorizacion del Representante</h6>
         <div class="picture" class="text-center">
            <div id="visor_f_autreprelegal" wire:ignore></div>
            @if ($f_autreprelegal)
            <embed id="pdf_f_autreprelegal" src='data:application/pdf;base64,{{ $f_autreprelegal }}' width='100%' height="215px" type='application/pdf'>
            @else
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" src="{{ asset('assets/images/others/adicional.jpg') }}" alt="">
            @endif
            <input class="inputImage" type="file" accept=".pdf" id="f_autreprelegal" wire:model="f_autreprelegal" required onchange="validateInputFilePdf('f_autreprelegal')">
         </div>
         @error('f_autreprelegal')
            <span class="text-danger">{{$message}}</span>
         @enderror
      </div>
   </div>
   <div class="col-sm-4">
      <div class="pictureContainer">
         <h6 class="text-center">Documento Adicional</h6>
         <div class="picture" class="text-center">
            <div id="visor_f_adicional2" wire:ignore></div>
            @if ($f_adicional2)
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" src="{{ asset('assets/images/others/pdf_on.jpg') }}" alt="">
            @else
            <img class="rounded mx-auto d-block img-thumbnail imgCustom" src="{{ asset('assets/images/others/adicional.jpg') }}" alt="">
            @endif
            <input class="inputImage" type="file" accept=".pdf,.jpg,.jpeg,.png" wire:model="f_adicional2" onchange="validateInputFilePdfJpg('f_adicional2')">
         </div>
         @error('f_adicional2')
            <span class="text-danger">{{$message}}</span>
         @enderror
      </div>
   </div>
</div>