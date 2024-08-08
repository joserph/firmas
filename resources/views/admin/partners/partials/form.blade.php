<div class="row">
    <div class="col-sm-8">
        <div class="mb-3" x-data x-init="$refs.name.focus()">
            <label for="name">Nombre Permiso</label>
            <input type="text" name="name" id="name" wire:model='name' x-ref="name" class="form-control text-uppercase @error('name') is-invalid @enderror" autofocus="true" data-autofocus required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-4">
        <div class="mb-3">
            <label for="name">Precio Preferencial</label>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" wire:model='preferential_price' @if ($preferential_price == 1) checked @endif class="form-check-input">
                    Si
                <i class="input-frame"></i></label>
            </div>
            
            @error('preferential_price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="name">Usuario</label>
            <select name="user_id" id="user_id" wire:model='user_id' class="form-select">
                <option value="">Seleccione Usuario</option>
                @foreach ($users as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            
            @error('user_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
