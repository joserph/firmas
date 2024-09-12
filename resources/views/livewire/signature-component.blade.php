@push('css')
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
@endpush
<div>
   <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
         <h4 class="mb-3 mb-md-0">Lista de Firmas</h4>
      </div>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb breadcrumb-dot">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista de Firmas</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-header">
               <div class="d-grid gap-2 d-md-flex">
                  <div class="col-auto col-sm-5">
                     <input type="search" wire:model.live.debounce.300ms='search' class="form-control" name="" id="" placeholder="Buscar...">
                  </div>
                  <div class="col-auto">
                     <label for="inputPassword6" class="col-form-label">Paginacion</label>
                  </div>
                  <div class="col-auto col-sm-1">
                     <select name="perPage" wire:model.live='perPage' id="perPage" class="form-select">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                     </select>
                  </div>
                  <form action="{{ route('import-signatures') }}" class="row g-3" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="col-auto">
                        <input type="file" class="form-control" name="importSignature" id="">
                     </div>
                     <div class="col-auto col-sm-1">
                        <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Subir">
                           <i class="fa-solid fa-file-arrow-up"></i>
                        </button>
                     </div>
                  </form>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive pt-3">
                  @if($signatures->isNotEmpty())
                  <table class="table table-hover table-sm">
                     <thead>
                        <tr>
                           <th wire:click='doSort("numerodocumento")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Cedula' columnName='numerodocumento' />
                           </th>
                           <th wire:click='doSort("ruc")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Ruc' columnName='ruc' />
                           </th>
                           <th wire:click='doSort("creacion")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Fecha' columnName='creacion' />
                           </th>
                           <th wire:click='doSort("nombres")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Nombres' columnName='nombres' />
                           </th>
                           <th wire:click='doSort("tipo_solicitud")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Tipo Firma' columnName='tipo_solicitud' />
                           </th>
                           <th wire:click='doSort("vigenciafirma")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Vigencia' columnName='vigenciafirma' />
                           </th>
                           <th wire:click='doSort("estado")' class="text-center" style="min-width: 210px">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Estado' columnName='estado' />
                           </th>
                           <th>Enviar</th>
                           <th>Consultar</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($signatures as $item)
                        <tr wire:key="{{ $item->id }}">
                           <div class="d-flex align-items-center">
                              <strong wire:loading.delay wire:target="sendingSignature({{ $item->id }})" role="status">Enviando...</strong>
                              <div wire:loading.delay wire:target="sendingSignature({{ $item->id }})" class="spinner-border ms-auto text-primary" aria-hidden="true"></div>
                            </div>
                            <div class="d-flex align-items-center">
                              <strong wire:loading.delay wire:target="signatureStatusQuery({{ $item->id }})" role="status">Enviando...</strong>
                              <div wire:loading.delay wire:target="signatureStatusQuery({{ $item->id }})" class="spinner-border ms-auto text-success" aria-hidden="true"></div>
                            </div>
                           {{-- <div  class="d-flex justify-content-center">
                              <div  class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                              </div>
                           </div> --}}
                           <td class="text-center align-middle">
                              <small>
                                 @if ($item->tipo_solicitud == 1)
                                    @if ($item->estado != 'SIN ENVIAR')
                                    {{ $item->numerodocumento }}
                                    @else
                                    <a href="{{ route('natural-persons.edit', $item) }}">{{ $item->numerodocumento }}</a>
                                    @endif
                                 @elseif ($item->tipo_solicitud == 2)
                                    @if ($item->estado != 'SIN ENVIAR')
                                    {{ $item->numerodocumento }}
                                    @else
                                    <a href="{{ route('legal-representatives.edit', $item) }}">{{ $item->numerodocumento }}</a>
                                    @endif
                                 @elseif ($item->tipo_solicitud == 3)
                                    @if ($item->estado != 'SIN ENVIAR')
                                    {{ $item->numerodocumento }}
                                    @else
                                    <a href="{{ route('company-members.edit', $item) }}">{{ $item->numerodocumento }}</a>
                                    @endif
                                 @endif
                              </small>
                           </td>
                           <td class="text-center align-middle"><small>{{ $item->ruc }}</small></td>
                           <td class="text-center align-middle"><small>{{ date('d-m-Y', strtotime($item->creacion)) }}</small></td>
                           <td class="text-center align-middle"><small>{{ $item->nombres }} {{ $item->apellido1 }} {{ $item->apellido2 }}</small></td>
                           <td class="text-center align-middle"><small>
                              @if ($item->tipo_solicitud == 1)
                                 PERSONA NATURAL
                              @elseif ($item->tipo_solicitud == 2)
                                 REPRESENTANTE LEGAL
                              @elseif ($item->tipo_solicitud == 3)
                                 MIEMBRO DE EMPRESA
                              @else
                              {{ $item->tipo_solicitud }}
                              @endif
                           </small></td>
                           <td class="text-center align-middle"><small>{{ $item->vigenciafirma }}</small></td>
                           <td class="text-center align-middle">
                              <select wire:change='changeInputSelect({{ $item->id }}, $event.target.value, $event.target.name)' name="estado" class="form-select form-select-sm" {{($item->fecha_nacimiento) ? $sendButton : ''}} >
                                 <option value="NULL">-</option>
                                 @foreach ($stateSignatures as $stateSignature)
                                 <option value="{{ $stateSignature }}" {{ ($stateSignature === $item->estado) ? 'selected' : '' }}>{{ $stateSignature }}</option>
                                 @endforeach
                              </select>
                           </td>
                           <td class="text-center">
                              <button type="submit" wire:loading.attr='disabled' class="btn btn-primary btn-sm" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" wire:click='sendingSignature({{$item->id}})' {{($item->estado == 'SIN ENVIAR') ? '' : $sendButton}}>
                                 <i class="fa-regular fa-paper-plane"></i> 
                              </button>
                           </td>
                           <td class="text-center">
                              <button type="submit" wire:loading.attr='disabled' class="btn btn-success btn-sm" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" wire:click='signatureStatusQuery({{$item->id}})' {{($item->estado != 'SIN ENVIAR') ? '' : $sendButton}}>
                                 <i class="fa-solid fa-down-left-and-up-right-to-center"></i>
                              </button>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                  @else
                  <p class="text-center">No se encontraron resultados con la busqueda <strong>"{{ $search }}"</strong> 😟</p>
                  @endif
                  {{ $signatures->links() }}
               </div>
            </div>
         </div>
      </div>
   </div>
   
   @push('js')
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      @if (Session::has('send'))
         <script>
            toastr.success("{{ Session::get('send') }}");
         </script>
      @endif
      @if (Session::has('error_send'))
         <script>
            toastr.error("{{ Session::get('error_send') }}");
         </script>
      @endif
      <script>
         $(document).ready(function(){
            toastr.options = {
               'progressBar': true,
               'positionClass': 'toast-top-right',
            }
         });

         window.addEventListener('success', event => {
            toastr.success(event.detail[0].message);
         })
         window.addEventListener('send', event => {
            toastr.success(event.detail[0].message);
         })
         window.addEventListener('error_send', event => {
            toastr.error(event.detail[0].message);
         })
         window.addEventListener('delete', event => {
            Swal.fire({
               title: "Esta seguro de eliminar el partner?",
               text: "No podrás revertir esto!",
               icon: "warning",
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Si, eliminalo!",
               cancelButtonText: "Cancelar"
               }).then((result) => {
               if (result.isConfirmed) {
                  Livewire.dispatch('delete-partner', {id: event.detail});
                  Swal.fire({
                     title: "Emilinado!",
                     text: "El permiso ha sido eliminado con exito.",
                     icon: "success"
                  });
               }
            });
         })
      </script>
   @endpush
  
</div>
