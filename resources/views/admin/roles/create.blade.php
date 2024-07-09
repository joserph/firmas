@extends('layouts.admin.app')
@section('title') Create role @stop
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Create role</h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dot">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role list</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create role</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    @include('layouts.message.errors')

                    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}

                        @include('admin.roles.partials.form')

                        {{ Form::button('<i data-feather="plus-circle"></i> ' . '', ['type' => 'submit', 'data-bs-toggle' => 'tooltip', 'data-bs-placement' => 'right', 'title' => 'Create', 'class' => 'btn btn-icon btn-outline-primary btn-sm']) }}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection