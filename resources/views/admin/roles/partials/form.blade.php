<div class="row">
    <div class="col-sm-6">
        <div class="mb-3">
            {!! Form::label('name', 'Rol Name', ['class' => 'form-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter rol name', 'autofocus']) !!}
        </div>
    </div><!-- Col -->

    <div class="col-sm-12">
        <div class="mb-3">
            {!! Form::label('roles', 'Permissions', ['class' => 'form-label']) !!}
            <div class="row">

            @foreach ($permission as $key => $item)

                <div class="col-2">
                    <label for="permission" class="form-check-label">
                        @isset($role)
                            {{-- {{ form::checkbox('permission[]', $item->id, in_array($item->id, $rolePermissions) ? true : false, ['class' => 'form-check-input', 'id' => 'permission']) }}
                            {{ $item->name }} --}}
                            <input class="form-check-input" name="permission[]" type="checkbox" @if (in_array($item->id, $rolePermissions))
                            checked="checked"
                            @endif value="{{$item->id}}" id="flexCheckDefault_{{$item->id}}">
                            <label class="form-check-label" for="flexCheckDefault_{{$item->id}}">
                                {{ $item->name }}
                            </label>
                        @else
                            <input class="form-check-input" name="permission[]" type="checkbox" value="{{$item->id}}" id="flexCheckDefault_{{$item->id}}">
                            <label class="form-check-label" for="flexCheckDefault_{{$item->id}}">
                                {{ $item->name }}
                            </label>
                            {{-- {!! form::checkbox('permission[]', $item->id, false, ['class' => 'form-check-input', 'id' => 'permission']) !!}
                            {{ $item->name }} --}}
                        @endisset

                    </label>
                </div>
            @endforeach

        </div>
        </div>
    </div><!-- Col -->
</div><!-- Row -->