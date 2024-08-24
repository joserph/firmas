@push('css')
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
@endpush
<div>
   <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
         <h4 class="mb-3 mb-md-0">Lista de Pagos</h4>
      </div>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb breadcrumb-dot">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista de Pagos</li>
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
                     <select name="perPage" wire:model.live='perPage' id="perPage" class="form-select form-select-sm">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive pt-3">
                  @if($consolidations->isNotEmpty())
                  <table class="table table-sm table-hover">
                     <thead>
                        <tr>
                           <th wire:click='doSort("numerodocumento")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Cedula' columnName='numerodocumento' />
                           </th>
                           <th wire:click='doSort("en_uanataca")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='En Uanataca' columnName='en_uanataca' />
                           </th>
                           {{-- <th wire:click='doSort("creacion")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Fecha' columnName='creacion' />
                           </th> --}}
                           <th wire:click='doSort("nombres")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Nombres' columnName='nombres' />
                           </th>
                           {{-- <th wire:click='doSort("tipo_solicitud")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Tipo Firma' columnName='tipo_solicitud' />
                           </th> --}}
                           <th wire:click='doSort("vigenciafirma")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Vigencia' columnName='vigenciafirma' />
                           </th>
                           <th wire:click='doSort("estado")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Estado' columnName='estado' />
                           </th>
                           <th wire:click='doSort("partner_id")' class="text-center" style="min-width: 180px">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Partner' columnName='partner_id' />
                           </th>
                           <th wire:click='doSort("penalidad")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Penalidad' columnName='penalidad' />
                           </th>
                           <th wire:click='doSort("pagado")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Monto pagado' columnName='pagado' />
                           </th>
                           <th wire:click='doSort("uanataca")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Monto Uanataca' columnName='uanataca' />
                           </th>
                           <th wire:click='doSort("ganancia")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Ganancia' columnName='ganancia' />
                           </th>
                           <th wire:click='doSort("saldo")' class="text-center" style="min-width: 120px">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Saldo' columnName='saldo' />
                           </th>
                           <th wire:click='doSort("consolidado_banco")' class="text-center" style="min-width: 147px">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Consolidado banco' columnName='consolidado_banco' />
                           </th>
                           <th wire:click='doSort("estado_pago")' class="text-center" style="min-width: 147px">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Estado Pago' columnName='estado_pago' />
                           </th>
                           <th wire:click='doSort("re-verificado")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Re-Verificado' columnName='re-verificado' />
                           </th>
                           <th wire:click='doSort("banco")' class="text-center" style="min-width: 209px">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Banco' columnName='banco' />
                           </th>
                           <th wire:click='doSort("ref_banco")' class="text-center" style="min-width: 180px">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Ref. Banco' columnName='ref_banco' />
                           </th>
                           <th wire:click='doSort("ref_deposito")' class="text-center" style="min-width: 180px">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Ref. Deposito' columnName='ref_deposito' />
                           </th>
                           <th wire:click='doSort("modo_pago")' class="text-center" style="min-width: 269px">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Modo Pago' columnName='modo_pago' />
                           </th>
                           <th wire:click='doSort("fecha_pago")' class="text-center">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Fecha Pago' columnName='fecha_pago' />
                           </th>
                           <th wire:click='doSort("nota")' class="text-center" style="min-width: 255px">
                              <x-datatable-item :sortColumn='$sortColumn' :sortDirection='$sortDirection' spanishName='Nota' columnName='nota' />
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($consolidations as $item)
                        <tr>
                           <td class="text-center align-middle"><small>{{ $item->signature->numerodocumento }}</small></td>
                           <td class="text-center align-middle">
                              <input class="form-check-input" type="checkbox" name="en_uanataca" wire:change='changeInputCheckbox({{ $item->id }}, $event.target.value, $event.target.name)' value="{{($item->en_uanataca === 1) ? 1 : 0 }}" {{ ($item->en_uanataca === 1) ? 'checked' : '' }}>
                           </td>
                           <td class="text-center align-middle"><small>{{ $item->signature->nombres }}</small></td>
                           <td class="text-center align-middle"><small>{{ $item->signature->vigenciafirma }}</small></td>
                           <td class="text-center align-middle"><small>{{ $item->signature->estado }}</small></td>
                           <td class="text-center align-middle">
                              <select wire:change='changePartner({{ $item->id }}, $event.target.value)' class="form-select form-select-sm" >
                                 <option value="NULL">-</option>
                                 @foreach ($partners as $partner)
                                 <option value="{{ $partner->id }}" {{ ($partner->id === $item->partner_id) ? 'selected' : '' }}>{{ $partner->name }}</option>
                                 @endforeach
                              </select>
                           </td>
                           <td class="text-center align-middle">
                              <input class="form-check-input" type="checkbox" name="penalidad" wire:change='changeInputCheckbox({{ $item->id }}, $event.target.value, $event.target.name)' value="{{($item->penalidad === 1) ? 1 : 0 }}" {{ ($item->penalidad === 1) ? 'checked' : '' }}>
                           </td>
                           <td class="text-center align-middle">
                              <div class="input-group input-group-sm">
                                 <span class="input-group-text" id="basic-addon1">$</span>
                                 <input type="text" class="form-control form-control-sm" value="{{ $item->monto_pagado }}" name="monto_pagado" wire:blur='changeInput({{ $item->id }}, $event.target.value, $event.target.name)'>
                              </div>
                           </td>
                           <td class="text-center align-middle">
                              <div class="input-group input-group-sm">
                                 <span class="input-group-text" id="basic-addon1">$</span>
                                 <input type="text" class="form-control form-control-sm" name="monto_uanataca" value="{{ $item->monto_uanataca }}" wire:blur='changeInput({{ $item->id }}, $event.target.value, $event.target.name)'>
                              </div>
                           </td>
                           <td class="text-center align-middle">$ {{ $item->ganancia }}</td>
                           <td class="text-center align-middle">
                              <div class="input-group input-group-sm">
                                 <span class="input-group-text" id="basic-addon1">$</span>
                                 <input type="text" class="form-control form-control-sm" name="saldo" value="{{ $item->saldo }}" wire:blur='changeInput({{ $item->id }}, $event.target.value, $event.target.name)'>
                              </div>
                           </td>
                           <td class="text-center align-middle">
                              <select wire:change='changeInputSelect({{ $item->id }}, $event.target.value, $event.target.name)' name="consolidado_banco" id="" class="form-select form-select-sm">
                                 <option value="NULL">-</option>
                                 @foreach ($consolidated_banks as $consolidated_bank)
                                 <option value="{{ $consolidated_bank }}" {{ ($item->consolidado_banco === $consolidated_bank) ? 'selected' : '' }}>{{ $consolidated_bank }}</option>
                                 @endforeach
                              </select>
                           </td>
                           <td class="text-center align-middle">
                              <select wire:change='changeInputSelect({{ $item->id }}, $event.target.value, $event.target.name)' name="estado_pago" class="form-select form-select-sm">
                                 <option value="NULL">-</option>
                                 @foreach ($payment_status as $payment_statu)
                                 <option value="{{ $payment_statu }}" {{ ($item->estado_pago === $payment_statu) ? 'selected' : '' }}>{{ $payment_statu }}</option>
                                 @endforeach
                              </select>
                           </td>
                           <td class="text-center align-middle">
                              <input class="form-check-input" type="checkbox" name="re_verificado" wire:change='changeInputCheckbox({{ $item->id }}, $event.target.value, $event.target.name)' value="{{($item->re_verificado === 1) ? 1 : 0 }}" {{ ($item->re_verificado === 1) ? 'checked' : '' }}>
                           </td>
                           <td class="text-center align-middle">
                              <select wire:change='changeInputSelect({{ $item->id }}, $event.target.value, $event.target.name)' name="banco" class="form-select form-select-sm">
                                 <option value="NULL">-</option>
                                 @foreach ($banks as $bank)
                                    <option value="{{ $bank }}" {{ ($item->banco === $bank) ? 'selected' : '' }}>{{ $bank }}</option>
                                 @endforeach
                              </select>
                           </td>
                           <td class="text-center align-middle">
                              <input type="text" class="form-control form-control-sm" name="ref_banco" value="{{ $item->ref_banco }}" wire:blur='changeInput({{ $item->id }}, $event.target.value, $event.target.name)'>
                           </td>
                           <td class="text-center align-middle">
                              <input type="text" class="form-control form-control-sm" name="ref_deposito" value="{{ $item->ref_deposito }}" wire:blur='changeInput({{ $item->id }}, $event.target.value, $event.target.name)'>
                           </td>
                           <td class="text-center align-middle">
                              <select wire:change='changeInputSelect({{ $item->id }}, $event.target.value, $event.target.name)' name="modo_pago" class="form-select form-select-sm">
                                 <option value="NULL">-</option>
                                 @foreach ($payment_methods as $payment_method)
                                    <option value="{{ $payment_method }}" {{ ($item->modo_pago === $payment_method) ? 'selected' : ''}}>{{ $payment_method }}</option>
                                 @endforeach
                              </select>
                           </td>
                           <td class="text-center align-middle">
                              <input type="date" class="form-control form-control-sm" name="fecha_pago" value="{{ $item->fecha_pago }}" wire:blur='changeInput({{ $item->id }}, $event.target.value, $event.target.name)'>
                           </td>
                           <td class="text-center align-middle">
                              <input type="text" class="form-control form-control-sm" name="nota" value="{{ $item->nota }}" wire:blur='changeInput({{ $item->id }}, $event.target.value, $event.target.name)'>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                  @else
                  <p class="text-center">No se encontraron resultados con la busqueda <strong>"{{ $search }}"</strong> 😟</p>
                  @endif
                  {{ $consolidations->links() }}
               </div>
            </div>
         </div>
      </div>
   </div>
   
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
         
      </script>
   @endpush
  
</div>
