@extends('layouts.app')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alerts.success-alert')
        @include('alerts.error-alert')

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-column flex-sm-row">
                <!-- Search -->
                <form action="{{ route('users.index') }}" method="GET" class="d-flex align-items-center mb-2 mb-sm-0 me-sm-2">
                    <input type="text" class="form-control me-2" placeholder="Izlash" name="search" value="{{ request('search') }}">

                    <button class="btn btn-primary me-2" type="submit">
                        <i class="bx bx-search"></i>
                    </button>
                </form>

                @include('users.create')

            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>To'liq ism</th>
                        <th>Telefon raqami</th>
                        <th>Joylashuvi</th>
                        <th>Oxirgi faollik</th>
                        <th>Amallar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>+998 {{ $user->phone }}</td>
                            <td>{{ $user->latitude }} {{$user->longitude}}</td>
                            <td>{{ $user->last_active_time }}</td>
                            <td>
                                <div class="d-flex">
                                    @include('users.edit')
                                    @include('users.delete')
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
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
                <!--/ Basic Pagination -->
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordToggleIcons = document.querySelectorAll('.form-password-toggle .input-group-text');

            passwordToggleIcons.forEach(function (icon) {
                icon.addEventListener('click', function () {
                    const input = icon.parentElement.querySelector('input');
                    const iconElement = icon.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        iconElement.classList.remove('bx-hide');
                        iconElement.classList.add('bx-show');
                    } else {
                        input.type = 'password';
                        iconElement.classList.remove('bx-show');
                        iconElement.classList.add('bx-hide');
                    }
                });
            });
        });
    </script>
@endsection
