@if(session('success'))
    <div id="success-alert" class="alert alert-success alert-dismissible" role="alert">
        <strong>Muvaffaqiyat!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopmoq"></button>
    </div>
@endif
