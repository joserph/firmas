@push('css')
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
@endpush
<div>
   <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
         <h4 class="mb-3 mb-md-0">Estadisticas de {{ $partner->name }}</h4>
      </div>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb breadcrumb-dot">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Estadisticas de {{ $partner->name }}</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-header">
               <div class="d-grid gap-2 d-md-flex">
                  <div class="col-auto">
                     <label for="inputPassword6" class="col-form-label">Año</label>
                  </div>
                  <div class="col-auto col-sm-1">
                     <select name="perYear" wire:model.live='perYear' id="perYear" class="form-select form-select-sm">
                        @foreach ($years as $year)
                           <option value="{{ $year }}" {{ ($perYear === $year) ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-auto">
                     <label for="inputPassword6" class="col-form-label">Mes</label>
                  </div>
                  @php
                     $mes = date('n');
                  @endphp
                  <div class="col-auto col-sm-2">
                     <select name="perMonth" wire:model.live='perMonth' id="perMonth" class="form-select form-select-sm">
                        @foreach ($months as $key => $month)
                           <option value="{{ $key }}" {{ ($perMonth === $key) ? 'selected' : '' }}>{{ $month }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-auto col-sm-2">
                     <select wire:model.live='paymentStatus' name="estado_pago" class="form-select form-select-sm">
                        <option value="NULL">-</option>
                        @foreach ($payment_status as $payment_statu)
                        <option value="{{ $payment_statu }}" {{ ($paymentStatus === $payment_statu) ? 'selected' : '' }}>{{ $payment_statu }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive pt-3">
                  <table class="table table-hover table-sm">
                     <thead>
                        <tr>
                           <th class="text-center">Descripcion</th>
                           <th class="text-center">Total</th>
                           <th class="text-center">7 Dias</th>
                           <th class="text-center">30 Dias</th>
                           <th class="text-center">1 año</th>
                           <th class="text-center">2 años</th>
                           <th class="text-center">3 años</th>
                           <th class="text-center">4 años</th>
                           <th class="text-center">5 años</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td class="">CANTIDADES</td>
                           <td class="text-center">{{ $totals }}</td>
                           @foreach ($counts as $item)
                              <td class="text-center">{{ $item }}</td>
                           @endforeach
                        </tr>
                        <tr>
                           <td class="">{{ $this->paymentStatus }}</td>
                           <td class="text-center">$ {{ number_format($debtsTotal, 2, '.', '') }}</td>
                           @foreach ($earnings as $item)
                              <td class="text-center">$ {{ number_format($item, 2, '.', '') }}</td>
                           @endforeach
                        </tr>
                     </tbody>
                  </table>
                  <hr>
                  <table class="table table-hover table-sm">
                     <thead>
                        <tr>
                           <th class="text-center">CEDULA</th>
                           <th class="text-center">FECHA</th>
                           <th class="text-center">NOMBRES</th>
                           <th class="text-center">TIPO FIRMAS</th>
                           <th class="text-center">VIGENCIA</th>
                           <th class="text-center">ESTADO</th>
                           <th class="text-center">PARTNER</th>
                           <th class="text-center">PENALIDAD</th>
                           <th class="text-center">MONTO</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php
                           $total = 0;
                        @endphp
                        @foreach ($allSignatures as $item)
                           <tr>
                              <td class="text-center">{{ $item->numerodocumento }}</td>
                              <td class="text-center">{{ date('d-m-Y', strtotime($item->creacion)) }}</td>
                              <td class="">{{ $item->nombres }} {{ $item->apellido1 }} {{ $item->apellido2 }}</td>
                              <td class="text-center">{{ $item->formato }}</td>
                              <td class="text-center">{{ $item->vigenciafirma }}</td>
                              <td class="text-center">{{ $item->estado }}</td>
                              <td class="text-center">{{ $partner->name }}</td>
                              <td class="text-center">
                                 @if ($item->penalidad === 1)
                                 <i class="fa-regular fa-circle-check text-success"></i>
                                 @else
                                 <i class="fa-regular fa-circle-xmark text-danger"></i>
                                 @endif
                              <td class="text-center">$ {{ number_format($item->monto_pagado, 2, '.', '') }}</td>
                           </tr>
                           @php
                              $total += floatval($item->monto_pagado);
                           @endphp
                        @endforeach
                     </tbody>
                     <tfoot>
                        @php
                        // dd($total . ' - ' . $debtsTotal);
                           if(floatval($total) != floatval($debtsTotal))
                           {
                              $color = 'danger';
                           }elseif($total === 0){
                              $color = 'dark';
                           }else{
                              $color = 'success';
                           }
                        @endphp
                        <tr>
                           <th class="text-end" colspan="8">Total</th>
                           <th class="text-center text-{{ $color }}">$ {{ number_format($total, 2, '.', '') }}</th>
                        </tr>
                     </tfoot>
                  </table>
                  
                  {{-- <table class="table table-hover table-sm">
                     <thead>
                        <tr>
                           <th>Partners</th>
                           <th>Deuda</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php
                           $total = 0;
                        @endphp
                        @foreach ($partners as $partner)
                           @foreach ($debts as $key => $item)
                              @if ($key === $partner->id)
                                 <tr>
                                    <td><a href="{{ route('statistics.show', $partner->id) }}">{{ $partner->name }}</a></td>
                                    <td>$ {{ number_format($item, 2, '.', '') }}</td>
                                    @php
                                       $total += $item;
                                    @endphp
                                 </tr>
                              @endif
                           @endforeach
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr>
                           <th>Total</th>
                           <th>$ {{ number_format($total, 2, '.', '') }}</th>
                        </tr>
                     </tfoot>
                  </table> --}}
               </div>
            </div>
            <img src="{{ route('image') }}" alt="">
         </div>
      </div>
   </div>
   
   @push('js')
      {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
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
