@if(session('success'))
    <div id="success-alert" class="alert alert-success alert-dismissible" role="alert">
        <strong>Muvaffaqiyat!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopmoq"></button>
    </div>
@endif

@if(session('error'))
    <div id="success-alert" class="alert alert-danger alert-dismissible" role="alert">
        <strong>Xatolik!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopmoq"></button>
    </div>
@endif
