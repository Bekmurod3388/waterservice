@extends('layouts.app')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alerts.success-alert')
        @include('alerts.error-alert')

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-column flex-sm-row">
                <form action="{{ route('clients.index') }}" method="GET"
                      class="d-flex align-items-center mb-2 mb-sm-0 me-sm-5">
                    <input type="text" class="form-control me-2" placeholder="Izlash" name="search"
                           value="{{ request('search') ? request('search') : '' }}">
                    <button class="btn btn-primary me-2" type="submit">
                        <i class="bx bx-search"></i>
                    </button>
                </form>

                <div class="d-flex align-items-center flex-grow-1 justify-content-between">
                    <div class="card-title mb-0">
                        @can('operator_dealer')
                            <h5 class="m-0 me-5">Oylik mijozlar soni</h5>
                            <small class="text-muted">{{ $clientCount }}</small>
                        @endcannot
                    </div>


                    @include('clients.create')
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>To'liq ism</th>
                        <th>Telefon raqami</th>
                        <th>Operator Dilleri</th>
                        <th>Telegram</th>
                        <th>Tavsif</th>
                        <th>Amallar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->operator?->name }}</td>
                            <td>{{ $client->telegram_id }}</td>
                            <td>{{ $client->description }}</td>
                            <td>
                                <div class="d-flex">
                                    @include('clients.edit')
                                    <a href="{{route('client.points.index',$client->id)}}" class="btn btn-success me-2">
                                        <i class="bx bx-map"></i>
                                    </a>

                                    <a href="{{route('clients.tasks.index',$client->id)}}" class="btn btn-primary me-2">
                                        <i class="bx bx-list-check"></i>
                                        <span class="badge bg-white text-primary ms-1">{{ $client->tasks_count }}</span>
                                    </a>
                                </div>
                            </td>
                            @empty
                                <td colspan="7" class="text-center">Ma'lumot yo'q</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <!-- Basic Pagination -->
                <div class="card-body">
                    {{ $clients->links('pagination::bootstrap-5') }}
                </div>
                <!--/ Basic Pagination -->
            </div>
        </div>
    </div>

@endsection
