@if(session('success'))
    <div id="success-alert" class="alert alert-success alert-dismissible" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopmoq"></button>
    </div>
@endif

@section('script')
    <script>
        const displayTime = 10000;

        setTimeout(function(){
            document.getElementById('success-alert').style.display = 'none';
        }, displayTime);
    </script>
@endsection
