@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
@endpush
<div>
   <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
         <h4 class="mb-3 mb-md-0">Lista de Permisos</h4>
      </div>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb breadcrumb-dot">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista de Permisos</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            @if (session('success'))
               <div class="alert alert-success">
                  {{ session('success') }}
               </div>
            @endif

            <div class="card-header">
               <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                  {{-- @can('create-user')
                        <a class="btn btn-icon btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="New" href="{{ route('users.create') }}">
                           <i data-feather="plus-circle"></i>
                        </a>
                  @endcan --}}
                  <button type="button" class="btn btn-primary" wire:click='openCreateModal()' data-bs-toggle="tooltip" data-bs-placement="top" title="Crear">
                     <i class="fa-solid fa-circle-plus"></i>
                  </button>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive pt-3">
                  <table class="table table-bordered table-hover border-primary table-sm">
                        <thead>
                           <tr>
                              <th class="text-center">Nombre</th>
                              <th class="text-center">Acciones</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($permissions as $item)
                           <tr>
                              <td class="text-center align-middle">{{ $item->name }}</td>
                              <td class="text-center">
                                    {{-- @can('edit-user') --}}
                                    <button wire:click="openCreateModal({{$item->id}})" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" class="btn btn-icon btn-outline-warning btn-xs">
                                       <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    {{-- @endcan --}}
                                    
                                    {{-- @can('delete-user') --}}
                                    {{-- {!! Form::open(['route' => ['users.destroy', $item->id], 'method' => 'DELETE', 'style' => 'display:inline']) !!}
                                       {{ Form::button('<i class="fa-solid fa-trash"></i> ' . '', ['type' => 'submit', 'data-bs-toggle' => 'tooltip', 'data-bs-placement' => 'top', 'title' => 'Delete', 'class' => 'btn btn-icon btn-outline-danger btn-xs', 'onclick' => 'return confirm("¿Seguro de eliminar el color?")']) }}
                                    {!! Form::close() !!} --}}
                                    <button class="btn btn-icon btn-outline-danger btn-xs" wire:click='$dispatch("delete", {{$item->id}})' data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar">
                                       <i class="fa-solid fa-trash"></i>
                                    </button>
                                    {{-- @endcan --}}
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                  </table>
                  {{ $permissions->links() }}
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
               <h1 class="modal-title fs-5" id="exampleModalLabel">{{ isset($myPermission) ? 'Editar' : 'Crear'}} permiso</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click='closeCreateModal' aria-label="Close"></button>
            </div>
            <div class="modal-body">
               @include('admin.permissions.partials.form')
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" wire:click='closeCreateModal'><i class="fa-solid fa-xmark"></i> Cerrar</button>
               <button type="button" class="btn {{ isset($myPermission) ? 'btn-outline-warning' : 'btn-outline-primary'}}" wire:click='savePermission'><i class="{{ isset($myPermission) ? 'fa-solid fa-rotate' : 'fa-regular fa-floppy-disk'}}"></i> {{ isset($myPermission) ? 'Actualizar' : 'Guardar'}}</button>
            </div>
            </div>
         </div>
      </div>
   @endif
   
   @push('js')
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      {{-- <script src="{{ asset('assets/js/iziToast.min.js') }}"></script> --}}
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
            // console.log(event.detail);
            // alert('algo');
            Swal.fire({
               title: "Esta seguro de eliminar el permiso?",
               text: "No podrás revertir esto!",
               icon: "warning",
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Si, eliminalo!",
               cancelButtonText: "Cancelar"
               }).then((result) => {
               if (result.isConfirmed) {
                  // Livewire.dispatch('permission-component', 'delete', event.detail);
                  Livewire.dispatch('delete-permission', {id: event.detail});
                  Swal.fire({
                     title: "Emilinado!",
                     text: "El permiso ha sido eliminado con exito.",
                     icon: "success"
                  });
               }
            });
         })
         
      </script>
      
      <script>
         // $wire.dispatch('delete', permissionId => {
         //    Swal.fire({
         //       title: "Are you sure?",
         //       text: "You won't be able to revert this!",
         //       icon: "warning",
         //       showCancelButton: true,
         //       confirmButtonColor: "#3085d6",
         //       cancelButtonColor: "#d33",
         //       confirmButtonText: "Yes, delete it!"
         //       }).then((result) => {
         //       if (result.isConfirmed) {
         //          Swal.fire({
         //             title: "Deleted!",
         //             text: "Your file has been deleted.",
         //             icon: "success"
         //          });
         //       }
         //    });
         // })
      </script>
      
   @endpush
</div>
