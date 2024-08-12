@push('css')
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
@endpush
<div>
   <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
         <h4 class="mb-3 mb-md-0">Lista de Partners</h4>
      </div>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb breadcrumb-dot">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista de Partners</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-header">
               <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                  <input type="search" wire:model.live.debounce.300ms='search' class="form-control" name="" id="" placeholder="Buscar...">
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
                  <button type="button" class="btn btn-primary" wire:click='openCreateModal()' data-bs-toggle="tooltip" data-bs-placement="top" title="Crear">
                     <i class="fa-solid fa-circle-plus"></i>
                  </button>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive pt-3">
                  <table class="table table-hover table-sm">
                        <thead>
                           <tr>
                              <th class="text-center">Nombre</th>
                              <th class="text-center">Precio Preferencial</th>
                              <th class="text-center">Acciones</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($partners as $item)
                           <tr>
                              <td class="text-center align-middle">{{ $item->name }}</td>
                              <td class="text-center align-middle">
                                 @if ($item->preferential_price == 1)
                                    <i class="fa-regular fa-circle-check text-success"></i>
                                 @else
                                    <i class="fa-regular fa-circle-xmark text-danger"></i>
                                 @endif
                              </td>
                              <td class="text-center">
                                    <button wire:click="openCreateModal({{$item->id}})" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" class="btn btn-icon btn-outline-warning btn-xs">
                                       <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    
                                    <button class="btn btn-icon btn-outline-danger btn-xs" wire:click='$dispatch("delete", {{$item->id}})' data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar">
                                       <i class="fa-solid fa-trash"></i>
                                    </button>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                  </table>
                  {{ $partners->links() }}
               </div>
            </div>
         </div>
      </div>
   </div>
   
   @if ($modal)
      <div class="modal fade show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog" style="display:block">
         <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="exampleModalLabel">{{ isset($myPartner) ? 'Editar' : 'Crear'}} partner</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click='closeCreateModal' aria-label="Close"></button>
            </div>
            <div class="modal-body">
               @include('admin.partners.partials.form')
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" wire:click='closeCreateModal'><i class="fa-solid fa-xmark"></i> Cerrar</button>
               <button type="button" class="btn {{ isset($myPartner) ? 'btn-outline-warning' : 'btn-outline-primary'}}" wire:click='savePartner'><i class="{{ isset($myPartner) ? 'fa-solid fa-rotate' : 'fa-regular fa-floppy-disk'}}"></i> {{ isset($myPartner) ? 'Actualizar' : 'Guardar'}}</button>
            </div>
            </div>
         </div>
      </div>
   @endif

   @push('js')
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
