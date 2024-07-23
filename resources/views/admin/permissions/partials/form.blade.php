<div class="row">
    <div class="col-sm-12">
        <div class="mb-3" x-data x-init="$refs.name.focus()">
            <label for="name">Nombre Permiso</label>
            <input type="text" name="name" id="name" wire:model='name' x-ref="name" class="form-control @error('name') is-invalid @enderror" autofocus="true" data-autofocus required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>