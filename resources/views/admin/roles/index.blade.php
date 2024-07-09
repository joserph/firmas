@extends('layouts.admin.app')
@section('title') Role List @stop
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Role list</h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dot">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Role list</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        @can('create-rol')
                        <a class="btn btn-icon btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="New" href="{{ route('roles.create') }}">
                            <i data-feather="plus-circle"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered table-hover border-primary table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $item)
                                <tr>
                                    <td class="text-center">{{ $item->name }}</td>
                                    <td class="text-center">
                                        @can('edit-rol')
                                        <a href="{{ route('roles.edit', $item->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="btn btn-icon btn-outline-warning btn-xs">
                                            <i data-feather="edit"></i>
                                        </a>
                                        @endcan
                                        @can('delete-rol')
                                        {!! Form::open(['route' => ['roles.destroy', $item->id], 'method' => 'DELETE', 'style' => 'display:inline']) !!}
                                            {!! Form::button('<i data-feather="trash"></i> ' . '', ['type' => 'submit', 'data-bs-toggle' => 'tooltip', 'data-bs-placement' => 'top', 'title' => 'Delete', 'class' => 'btn btn-icon btn-outline-danger btn-xs', 'onclick' => 'return confirm("¿Seguro de eliminar el color?")']) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination">
                            {!! $roles->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection