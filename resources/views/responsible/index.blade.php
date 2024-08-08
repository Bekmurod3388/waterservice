@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alerts.success-alert')
        @include('alerts.error-alert')


        <div class="card">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center flex-column flex-sm-row">
                    <!-- Search -->
                    <form action="{{ route('responsible.index') }}" method="GET" class="d-flex align-items-center mb-2 mb-sm-0 me-sm-2">
                        <input type="text" class="form-control me-2" placeholder="Izlash" name="search" value="{{ request('search') ? request('search') : '' }}">

                        <button class="btn btn-primary me-2" type="submit">
                            <i class="bx bx-search"></i>
                        </button>
                    </form>

                    @include('responsible.create')
                    @include('responsible.edit')

                </div>
            <h5 class="card-header">
                Masullar jadvali
            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Operator</th>
                        <th>Kassir</th>
                        <th>Date</th>
                        <th>Amallar</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($responsible as $val)
                        <tr>
                            <td>{{$val->id}}</td>
                            <td>{{$val->operator->name}}</td>
                            <td>{{$val->cashier->name}}</td>
                            <td>{{\Carbon\Carbon::createFromFormat('Y-m', $val->month)->format('F')}}</td>
                            <td>
                                <button
                                    onclick="editModal({{$val->id}})"
                                    type="button"
                                    class="btn btn-warning me-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No logs available.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <!-- Basic Pagination -->
                <div class="card-body">
                    {{ $responsible->links('pagination::bootstrap-5') }}
                </div>
                <!--/ Basic Pagination -->
            </div>

        </div>
    </div>
@endsection
