<div class="row">
    <div class="col-sm-7">
        <div class="mb-3">
            {!! Form::label('title', 'Name Post', ['class' => 'form-label']) !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter name post', 'autofocus']) !!}
        </div>
    </div><!-- Col -->
    
    <div class="col-sm-7">
        <div class="mb-3">
            {!! Form::label('content', 'Content Post', ['class' => 'form-label']) !!}
            {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Enter content post']) !!}
        </div>
    </div><!-- Col -->
</div><!-- Row -->