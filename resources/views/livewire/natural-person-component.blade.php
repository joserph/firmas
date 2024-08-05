@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-steps/jquery.steps.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendors/dropify/dist/dropify.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/myCustomCss.css') }}">
@endpush
<div>
   <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
         <h4 class="mb-3 mb-md-0">Persona Natural</h4>
      </div>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb breadcrumb-dot">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('signatures') }}">Firmas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Persona Natural</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               {{-- <h4 class="card-title">Horizontal wizard</h4> --}}
               {{-- <p class="card-description">Read the <a href="http://www.jquery-steps.com/" target="_blank"> Official jQuery Steps Documentation </a>for a full list of instructions and other options.</p> --}}
               {{-- <div id="wizard">
                  <h2>Datos Personales</h2>
                  <section>
                     <form>
                        @include('admin.natural-persons.partials.form')
                     </form>
                  </section>

                  <h2>Second Step</h2>
                  <section>
                  <h4>Heading</h4>
                  <p>Donec mi sapien, hendrerit nec egestas a, rutrum vitae dolor. Nullam venenatis diam ac ligula elementum pellentesque. 
                        In lobortis sollicitudin felis non eleifend. Morbi tristique tellus est, sed tempor elit. Morbi varius, nulla quis condimentum 
                        dictum, nisi elit condimentum magna, nec venenatis urna quam in nisi. Integer hendrerit sapien a diam adipiscing consectetur. 
                        In euismod augue ullamcorper leo dignissim quis elementum arcu porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Vestibulum leo velit, blandit ac tempor nec, ultrices id diam. Donec metus lacus, rhoncus sagittis iaculis nec, malesuada a diam. 
                        Donec non pulvinar urna. Aliquam id velit lacus.</p>
                  </section>

                  
               </div> --}}
               <div class="container text-center">
                  <div class="row">
                    {{-- @if($currentStep > 1) --}}
                    <button wire:click="decrementSteps" class="col bg-{{ $headerButton }} text-{{ $headerText }} pt-2 pb-2 custom-button">
                        <p class="me-3">DATOS PERSONALES</p>
                    </button>
                    {{-- @endif --}}
                    <button wire:click="incrementSteps" class="col bg-{{ $headerButton2 }} text-{{ $headerText2 }} pt-2 pb-2 custom-button">
                        <p class="me-3">ARCHIVOS</p>
                    </button>
                  </div>
               </div>
               <hr>
               <form action="" enctype="multipart/form-data">
               @if ($currentStep === 1)
                  @include('admin.natural-persons.partials.form')
               @elseif($currentStep === 2)
                  @include('admin.natural-persons.partials.form2')
               @endif
               </form>
               <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                  @if($currentStep > 1)
                  <button wire:click="decrementSteps" class="btn btn-primary"><i class="fa-solid fa-chevron-left"></i> Atras</button>
                  @endif
                  @if($currentStep < $totalStep)
                  <button wire:click="incrementSteps" class="btn btn-primary">Siguiente <i class="fa-solid fa-chevron-right"></i></button>
                  @endif
                  @if($currentStep === $totalStep)
                  <button wire:click="saveNaturalPerson" class="btn btn-success">Guardar <i class="fa-regular fa-floppy-disk"></i></button>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>

   @push('js')
   {{-- <script src="{{ asset('assets/js/jquery.steps.min.js') }}"></script> --}}
   {{-- <script src="{{ asset('assets/js/template.js') }}"></script> --}}
   {{-- <script src="{{ asset('assets/js/wizard.js') }}"></script> --}}
   {{-- <script src="{{ asset('assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
   <script src="{{ asset('assets/vendors/dropify/dist/dropify.min.js') }}"></script>
   <script src="{{ asset('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
   <script src="{{ asset('assets/js/dropify.js') }}"></script> --}}
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script>
      function validar_Cedula(obj){
         // console.log('Entro')
            var p = navigator.mediaDevices.getUserMedia({ audio: true, video: true });
            $("#cedulaP-error").html("");
            $("#cedulaP-error").hide();
            // obj.style.backgroundColor = "";
            $("#tipodocumento-error").html("");
            $("#tipodocumento-error").hide();
            
            $("#btnSiguiente").show();
            obj.value = obj.value.trim();
            var xCedula = obj.value.trim();
            xTipoDoc = document.getElementById('tipodocumento').value;
            // console.log(xTipoDoc)
            if(xTipoDoc=="CEDULA"){
                if (xCedula.length > 0 && xCedula.length != 10) {
                  //   obj.style.backgroundColor = "#f5aca8";
                    if (xCedula.length > 0) {
                        $("#cedulaP-error").html("Cédula incorrecta");
                        $("#cedulaP-error").show();
                        // obj.style.backgroundColor = "#f5aca8";     /*  #FF6347  */
                        $("#btnSiguiente").hide();
                        obj.value = '';
                        Swal.fire({
                            icon: 'error',
                            title: 'Cédula incorrecta',
                            text: 'Su cédula no está correcta.'
                        });
                    }
                    if (xCedula.length == 0) {
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Cédula es necesaria',
                            text: 'Su número de cédula es indispensable para esta solicitud.'
                        });
                    }
                    return false ; 
                }  else{
                    //Preguntamos si la cedula consta de 10 digitos
                    if (xCedula.length == 10) {
                
                        //Obtenemos el digito de la region que son los dos primeros digitos
                        var digito_region = xCedula.substring(0, 2);
                
                        //Pregunto si la region existe ecuador se divide en 24 regiones
                        if (digito_region >= 1 && digito_region <= 60) {
                
                            // Extraigo el ultimo digito
                            var ultimo_digito = xCedula.substring(9, 10);
                
                            //Agrupo todos los pares y los sumo
                            var pares = parseInt(xCedula.substring(1, 2)) + parseInt(xCedula.substring(3, 4)) + parseInt(xCedula.substring(5, 6)) + parseInt(xCedula.substring(7, 8));
                
                            //Agrupo los impares, los multiplico por un factor de 2, si la resultante es > que 9 le restamos el 9 a la resultante
                            var numero1 = xCedula.substring(0, 1);
                            var numero1 = (numero1 * 2);
                            if (numero1 > 9) {
                                var numero1 = (numero1 - 9);
                            }
                
                            var numero3 = xCedula.substring(2, 3);
                            var numero3 = (numero3 * 2);
                            if (numero3 > 9) {
                                var numero3 = (numero3 - 9);
                            }
                
                            var numero5 = xCedula.substring(4, 5);
                            var numero5 = (numero5 * 2);
                            if (numero5 > 9) {
                                var numero5 = (numero5 - 9);
                            }
                
                            var numero7 = xCedula.substring(6, 7);
                            var numero7 = (numero7 * 2);
                            if (numero7 > 9) {
                                var numero7 = (numero7 - 9);
                            }
                
                            var numero9 = xCedula.substring(8, 9);
                            var numero9 = (numero9 * 2);
                            if (numero9 > 9) {
                                var numero9 = (numero9 - 9);
                            }
                
                            var impares = numero1 + numero3 + numero5 + numero7 + numero9;
                
                            //Suma total
                            var suma_total = (pares + impares);
                
                            //DiegoC:  Corregido esta sección estaba mal
                            var residuo = suma_total.toString().slice(-1);
                            if(residuo==0){
                                digito_validador=0;
                            }else{
                                digito_validador = 10 - residuo;
                            }
                
                            //Si el digito validador es = a 10 toma el valor de 0
                            if (digito_validador == 10)
                                var digito_validador = 0;
                
                            //Validamos que el digito validador sea igual al de la cedula
                            if (digito_validador == ultimo_digito) {
                                // console.log('la cedula:' + cedula + ' es correcta');
                                //return true;
                              //   obj.style.backgroundColor = "";
                            } else {
                                // console.log('la cedula:' + cedula + ' es incorrecta');
                                //return false;
                              //   obj.style.backgroundColor = "#f5aca8";
                                $("#cedulaP-error").html("Cédula incorrecta");
                                $("#cedulaP-error").show();
                                $("#btnSiguiente").hide();
                                obj.value = '';
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Cédula incorrecta',
                                    text: 'El número de cédula ingresado es incorrecto.'
                                })
                            }
                
                        } else {
                            // imprimimos en consola si la region no pertenece
                            // console.log('Esta cedula no pertenece a ninguna region');
                            //return false;
                           //  obj.style.backgroundColor = "#f5aca8";
                            $("#cedulaP-error").html("Cédula incorrecta");
                            $("#cedulaP-error").show();
                            $("#btnSiguiente").hide();
                            obj.value = '';
                            Swal.fire({
                                icon: 'error',
                                title: 'Cédula incorrecta',
                                text: 'El número de cédula ingresado es incorrecto.'
                            })
                        }
                    } else {
                        //imprimimos en consola si la cedula tiene mas o menos de 10 digitos
                        // console.log('Esta cedula tiene menos de 10 Digitos');
                        //return false;
                        if (xCedula.length > 0) {
                           //  obj.style.backgroundColor = "#f5aca8";
                            $("#cedulaP-error").html("Cédula incorrecta");
                            $("#cedulaP-error").show();
                            $("#btnSiguiente").hide();
                            obj.value = '';
                            Swal.fire({
                                icon: 'error',
                                title: 'Cédula incorrecta',
                                text: 'El número de cédula ingresado es incorrecto.'
                            })
                        }
                    }
                }
            }
            if(xTipoDoc==""){
               // alert('entro')
                $("#tipodocumento-error").html("Este dato es necesario.");
                $("#tipodocumento-error").show();
                $('#tipodocumento').addClass('is-invalid');
                Swal.fire({
                    icon: 'error',
                    title: 'Campo vacío',
                    text: 'Es necesario que seleccionar el tipo de documento.'
                });
            }
        }
   </script>
   @endpush
</div>