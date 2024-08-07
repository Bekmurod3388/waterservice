@extends('layouts.app')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alerts.success-alert')
        @include('alerts.error-alert')

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-column flex-sm-row">
                <!-- Search -->
                <form action="{{ route('agents.index') }}" method="GET" class="d-flex align-items-center mb-2 mb-sm-0 me-sm-2">
                    <input type="text" class="form-control me-2" placeholder="Izlash" name="search" value="{{ request('search') ? request('search') : '' }}">

                    <button class="btn btn-primary me-2" type="submit">
                        <i class="bx bx-search"></i>
                    </button>
                </form>

                {{--                @include('users.create')--}}

            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>To'liq ism</th>
                        <th>Telefon raqami</th>
                        <th>Bugungi ishlar</th>
                        <th>Amallar</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($agents as $agent)
                        <tr>
                            <td>{{ $agent->id }}</td>
                            <td>{{ $agent->name }}</td>
                            <td>{{ $agent->phone }}</td>
                            <td>
                                <span style="color: blue">
                                    {{ $agent->complete_tasks + $agent->incomplete_tasks }}
                                </span>/
                                <span style="color: green">
                                    {{ $agent->complete_tasks }}
                                </span>/
                                <span style="color: red">
                                    {{ $agent->incomplete_tasks }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{route('agent.products',$agent->id)}}" class="btn btn-primary"><i class="bx bxs-cart"></i></a>
                                    <a href="{{route('agent.tasks',$agent->id)}}" class="btn btn-danger" style="margin-left: 5px"><i class="bx bxs-wrench"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Ma'lumot yo'q</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <!-- Basic Pagination -->
                <div class="card-body">
                    {{ $agents->links('pagination::bootstrap-5') }}
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
