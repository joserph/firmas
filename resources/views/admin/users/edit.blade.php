@extends('layouts.admin.app')
@section('title') Edit user @stop
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Create user</h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dot">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User list</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit user</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    @include('layouts.message.errors')

                    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}

                        @include('admin.users.partials.form')

                        {{ Form::button('<i data-feather="refresh-ccw"></i> ' . '', ['type' => 'submit', 'data-bs-toggle' => 'tooltip', 'data-bs-placement' => 'right', 'title' => 'Update', 'class' => 'btn btn-icon btn-outline-warning btn-sm']) }}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection