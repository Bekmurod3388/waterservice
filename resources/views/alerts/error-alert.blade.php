@if(session('error'))
    <div id="success-alert" class="alert alert-danger alert-dismissible" role="alert">
        <strong>Xato!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopmoq"></button>
    </div>
@endif
