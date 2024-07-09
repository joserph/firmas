@extends('layouts.admin.app')
@section('title') Blog List @stop
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Blog list</h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dot">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog list</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        @can('create-blog')
                        <a class="btn btn-icon btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="New" href="{{ route('blogs.create') }}">
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
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Content</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $item)
                                <tr>
                                    <td class="text-center">{{ $item->title }}</td>
                                    <td class="text-center">{{ $item->content }}</td>
                                    <td class="text-center">
                                        @can('edit-blog')
                                        <a href="{{ route('blogs.edit', $item->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="btn btn-icon btn-outline-warning btn-xs">
                                            <i data-feather="edit"></i>
                                        </a>
                                        @endcan
                                        
                                        @can('delete-blog')
                                        {!! Form::open(['route' => ['blogs.destroy', $item->id], 'method' => 'DELETE', 'style' => 'display:inline']) !!}
                                            {{ Form::button('<i data-feather="trash"></i> ' . '', ['type' => 'submit', 'data-bs-toggle' => 'tooltip', 'data-bs-placement' => 'top', 'title' => 'Delete', 'class' => 'btn btn-icon btn-outline-danger btn-xs', 'onclick' => 'return confirm("¿Seguro de eliminar el color?")']) }}
                                        {!! Form::close() !!}
                                        @endcan
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination">
                            {!! $blogs->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection