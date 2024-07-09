@if ($errors->any())
    
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i data-feather="alert-circle"></i> Attention!, correct the following errors</strong><br>
        @foreach ($errors->all() as $error)
            <span class="badge badge-danger">{{ $error }}</span><br>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
    </div>
@endif