@push('css')
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
@endpush
<div>
   <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
         <h4 class="mb-3 mb-md-0">Estadisticas</h4>
      </div>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb breadcrumb-dot">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Estadisticas</li>
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
                     <select name="perYear" wire:model.live='perYear' id="perYear" class="form-select">
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
                     <select name="perMonth" wire:model.live='perMonth' id="perMonth" class="form-select">
                        @foreach ($months as $key => $month)
                           <option value="{{ $key }}" {{ ($perMonth === $key) ? 'selected' : '' }}>{{ $month }}</option>
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
                           <td class="">Cantidades</td>
                           <td class="text-center">{{ $totals }}</td>
                           @foreach ($counts as $item)
                              <td class="text-center">{{ $item }}</td>
                           @endforeach
                           {{-- <td class="text-center">{{ $sevenDays }}</td>
                           <td class="text-center">{{ $thirtyDays }}</td>
                           <td class="text-center">{{ $oneYears }}</td>
                           <td class="text-center">{{ $twoYears }}</td>
                           <td class="text-center">{{ $threeYears }}</td>
                           <td class="text-center">{{ $fourYears }}</td>
                           <td class="text-center">{{ $fiveYears }}</td> --}}
                        </tr>
                        <tr>
                           <td class="">Ganancias</td>
                           <td class="text-center">$ {{ $totalsEarnings->sum('consolidations_sum_ganancia') }}</td>
                           @foreach ($earnings as $item)
                              <td class="text-center">$ {{ number_format($item->sum('consolidations_sum_ganancia'), 2, '.', '') }}</td>
                           @endforeach
                           {{-- <td class="text-center">$ {{ $sevenDaysEarnings->sum('consolidations_sum_ganancia') }}</td>
                           <td class="text-center">$ {{ $thirtyDaysEarnings->sum('consolidations_sum_ganancia') }}</td>
                           <td class="text-center">$ {{ $oneYearsEarnings->sum('consolidations_sum_ganancia') }}</td>
                           <td class="text-center">$ {{ $twoYearsEarnings->sum('consolidations_sum_ganancia') }}</td>
                           <td class="text-center">$ {{ $threeYearsEarnings->sum('consolidations_sum_ganancia') }}</td>
                           <td class="text-center">$ {{ $fourYearsEarnings->sum('consolidations_sum_ganancia') }}</td>
                           <td class="text-center">$ {{ $fiveYearsEarnings->sum('consolidations_sum_ganancia') }}</td> --}}
                        </tr>
                     </tbody>
                  </table>
                  <hr>
                  <table class="table table-hover table-sm">
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
                                    <td>{{ $partner->name }}</td>
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
                        {{-- @foreach ($partnerUniques as $partneru)
                           @php
                              $debt = 0;
                           @endphp
                           @foreach ($partnersDebts as $item)
                              @if ($item->partner_id === $partneru['partner_id'])
                                 @php
                                    if($item->monto_pagado < 1)
                                    {
                                       $debt += 17;
                                    }
                                 @endphp
                              @endif
                           @endforeach
                           @foreach ($partners as $partner)
                              @if ($partner->id === $partneru['partner_id'])
                                 <tr>
                                    <td>{{ $partner->name }}</td>
                                    <td>{{ $debt }}</td>
                                 </tr>
                              @endif
                           @endforeach
                           
                        @endforeach --}}
                        
                     </tbody>
                  </table>
               </div>
            </div>
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
