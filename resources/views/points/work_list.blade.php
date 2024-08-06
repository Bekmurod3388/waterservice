@extends('layouts.app')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alerts.success-alert')
        @include('alerts.error-alert')

        <div class="card">

            <div class="card-header d-flex justify-content-start align-items-center flex-column flex-md-row">
                <!-- Search Form -->
                <form action="{{ route('work.list') }}" method="GET" class="d-flex align-items-center mb-2 mb-sm-0 me-sm-2">
                    <input type="text" class="form-control me-2" placeholder="Izlash" name="search" value="{{ request('search') }}">
                    <!-- Filter Dropdown -->
                    <div class="btn-group me-1">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <span><i class="bx bx-filter me-sm-1"></i> Kunlar</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item btn-outline-primary" href="{{ route('work.list', ['filter' => 'yesterday']) }}">Muddati
                                    otgan</a></li>
                            <li><a class="dropdown-item btn-outline-primary"
                                   href="{{ route('work.list', ['filter' => 'today']) }}">Bugun</a>
                            </li>
                            <li><a class="dropdown-item btn-outline-primary"
                                   href="{{ route('work.list', ['filter' => 'tomorrow']) }}">Ertaga</a></li>
                            <li><a class="dropdown-item btn-outline-primary"
                                   href="{{ route('work.list', ['filter' => 'week']) }}">Haftalik</a>
                            </li>
                        </ul>
                    </div>

                    <button class="btn btn-primary me-2" type="submit">
                        <i class="bx bx-search"></i>
                    </button>
                </form>
            </div>


            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mijoz</th>
                        <th>Telefon raqami</th>
                        <th>Tuman</th>
                        <th>Manzil</th>
                        <th>Filtr almashtirish sanasi</th>
                        <th>Oxirgi izoh</th>
                        <th>Amallar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($points as $point)
                        <tr>
                            <td>{{ $point->id }}</td>
                            <td>{{ $point->client->name }}</td>
                            <td>{{ $point->client->phone }}</td>
                            <td>{{ $point->region->name }}</td>
                            <td>{{ $point->address }}</td>
                            <td>
                                @include('points.change_filter')
                            </td>
                            <td>{{ $point->lastreason?->reason }}</td>
                            <td>
                                <div class="d-flex">
                                    @include('points.agent', ['client_id' => $point->client_id, 'point_id' => $point->id])
                                </div>
                            </td>
                            @empty
                                <td colspan="6" class="text-center">Ma'lumot yo'q</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <!-- Basic Pagination -->
                {{--                <div class="card-body">--}}
                {{--                    {{ $points->links('pagination::bootstrap-5') }}--}}
                {{--                </div>--}}
                {{--                <!--/ Basic Pagination -->--}}
            </div>
        </div>
    </div>

@endsection
