@if(session('error'))
    <div id="success-alert" class="alert alert-danger alert-dismissible" role="alert">
        <strong>Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopmoq"></button>
    </div>
@endif

@section('script')
    <script>
        const displayTime = 5000;

        setTimeout(function(){
            document.getElementById('success-alert').style.display = 'none';
        }, displayTime);
    </script>
@endsection
