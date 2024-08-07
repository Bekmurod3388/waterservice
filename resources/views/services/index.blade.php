@extends('layouts.app')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        @include('alerts.success-alert')
        @include('alerts.error-alert')

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-column flex-sm-row">
                <!-- Search -->
                <form action="{{ route('services.index') }}" method="GET" class="d-flex align-items-center mb-2 mb-sm-0 me-sm-2">
                    <input type="text" class="form-control me-2" placeholder="Izlash" name="search" value="{{ request('search') ? request('search') : '' }}">

                    <button class="btn btn-primary me-2" type="submit">
                        <i class="bx bx-search"></i>
                    </button>
                </form>


                @include('services.create')


            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Servis nomi</th>
                        <th>Narxi</th>
                        <th>Amallar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->cost }}</td>
                            <td>
                                <div class="d-flex">

                                    @include('services.edit')
                                    @include('services.delete')

                                </div>
                            </td>
                            @empty
                                <td colspan="4" class="text-center">Ma'lumot yo'q</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <!-- Basic Pagination -->
                <div class="card-body">
                    {{ $services->links('pagination::bootstrap-5') }}
                </div>
                <!--/ Basic Pagination -->
            </div>
        </div>
    </div>

@endsection
