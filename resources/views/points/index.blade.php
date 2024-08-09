@extends('layouts.app')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alerts.success-alert')
        @include('alerts.error-alert')

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-column flex-sm-row">
                <!-- Search -->
                <form action="" method="GET" class="d-flex align-items-center mb-2 mb-sm-0 me-sm-2">
                    <input type="text" class="form-control me-2" placeholder="Izlash" name="search" value="{{ request('search') ? request('search') : '' }}">

                    <button class="btn btn-primary me-2" type="submit">
                        <i class="bx bx-search"></i>
                    </button>
                </form>


                @include('points.create')


            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mijoz</th>
                        <th>Telefon raqami</th>
                        <th>Tuman</th>
                        <th>Lat/Long</th>
                        <th>Manzil</th>
                        @unlessrole('operator_dealer')
                            <th>Filter almashtirish sanasi</th>
                            <th>Shartnoma sanasi </th>
                            <th>Filter o'rnatilgan sana</th>
                        @endunlessrole
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
                            <td>{{ $point->latitude }}/{{ $point->longitude }}</td>
                            <td>{{ $point->address }}</td>
                            @unlessrole('operator_dealer')
                                <td>{{ $point->filter_expire_date?->format('d.m.Y') }}</td>
                                <td>{{ $point->contract_date?->format('d.m.Y') }}</td>
                                <td>{{ $point->installation_date?->format('d.m.Y') }}</td>
                            @endunlessrole
                            <td>
                                <div class="d-flex">
                                    @include('points.edit')
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
                    {{ $points->links('pagination::bootstrap-5') }}
                </div>
                <!--/ Basic Pagination -->
            </div>
        </div>
    </div>

@endsection
