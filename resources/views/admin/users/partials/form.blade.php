<div class="row">
    <div class="col-sm-6">
        <div class="mb-3">
            {!! Form::label('name', 'First Name', ['class' => 'form-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter first name', 'autofocus']) !!}
        </div>
    </div><!-- Col -->
    <div class="col-sm-6">
        <div class="mb-3">
            {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter email']) !!}
        </div>
    </div><!-- Col -->
</div><!-- Row -->
<div class="row">
    <div class="col-sm-4">
        <div class="mb-3">
            {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter password']) !!}
        </div>
    </div><!-- Col -->
    <div class="col-sm-4">
        <div class="mb-3">
            {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'form-label']) !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) !!}
        </div>
    </div><!-- Col -->
    <div class="col-sm-4">
        <div class="mb-3">
            {!! Form::label('roles', 'Role', ['class' => 'form-label']) !!}
            {{ Form::select('roles', $roles, [], ['class' => 'form-select', 'placeholder' => 'Seleccione role']) }}
        </div>
    </div><!-- Col -->
</div><!-- Row -->