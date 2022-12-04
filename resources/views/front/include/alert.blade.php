@if(session('success'))
    <div class="alert alert-success alert-dismissible alert-component">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>{{ session('success') }}</strong>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible alert-component">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>{{ session('error') }}</strong>
    </div>
@endif
