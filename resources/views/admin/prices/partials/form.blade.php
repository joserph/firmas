<div class="row">
   <div class="col-sm-6">
      <div class="mb-3" x-data x-init="$refs.validity.focus()">
         <label for="validity">Vigencia</label>
         <select class="form-select mb-2 @error('validity') is-invalid @enderror" wire:model="validity" required>
            <option selected="">Seleccione vigencia</option>
            @foreach ($validities as $item)
            <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
         </select>
         @error('validity')
            <span class="text-danger">{{ $message }}</span>
         @enderror
      </div>
   </div>
   <div class="col-sm-6">
      <div class="mb-3">
         <label for="amount">Valor</label>
         <input type="text" name="amount" id="amount" wire:model='amount' class="form-control text-uppercase @error('amount') is-invalid @enderror" required>
         @error('amount')
            <span class="text-danger">{{ $message }}</span>
         @enderror
      </div>
   </div>
   <div class="col-sm-4">
      <div class="mb-3">
         <label for="type_price">Tipo de precio</label>
         <select name="type_price" id="type_price" wire:model.live='type_price' class="form-select @error('type_price') is-invalid @enderror" required>
            <option value="">Seleccione tipo</option>
            @foreach ($typePrices as $item)
            <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
         </select>
         @error('type_price')
            <span class="text-danger">{{ $message }}</span>
         @enderror
      </div>
   </div>
   <div class="col-sm-4">
      <div class="mb-3">
         <label for="start_date">Fecha inicio</label>
         <input type="date" name="start_date" id="start_date" wire:model='start_date' {{ $disabledStarDate }} class="form-control text-uppercase @error('start_date') is-invalid @enderror">
         @error('start_date')
            <span class="text-danger">{{ $message }}</span>
         @enderror
      </div>
   </div>
   <div class="col-sm-4">
      <div class="mb-3">
         <label for="final_date">Fecha final</label>
         <input type="date" name="final_date" id="final_date" wire:model='final_date' {{ $disabledFinalDate }} class="form-control text-uppercase @error('final_date') is-invalid @enderror">
         @error('final_date')
            <span class="text-danger">{{ $message }}</span>
         @enderror
      </div>
   </div>
   <div class="col-sm-6">
      <div class="mb-3">
         <label for="promo_name">Nombre promo</label>
         <input type="text" name="promo_name" id="promo_name" wire:model='promo_name' class="form-control text-uppercase @error('promo_name') is-invalid @enderror">
         @error('promo_name')
            <span class="text-danger">{{ $message }}</span>
         @enderror
      </div>
   </div>
</div>