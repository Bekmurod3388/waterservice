@extends('layouts.app')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alerts.success-alert')
        @include('alerts.error-alert')

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-column flex-sm-row">
                <!-- Search -->
                <form action="" method="GET" class="d-flex align-items-center mb-2 mb-sm-0 me-sm-2">
                    <input type="text" class="form-control me-2" placeholder="Izlash" name="search" value="">
                    <input type="date" class="form-control me-2" name="from" value="">
                    <input type="date" class="form-control me-2" name="to" value="">

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
                        <th>Manzil</th>
                        <th>Telefon</th>
                        <th>Izoh</th>
                        <th>Yakunlandimi</th>
                        <th>Servis narx</th>
                        <th>Mahsulotlar</th>
                        <th>Xizmat vaqti</th>
                        <th>Amallar</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->client->name }}</td>
                            <td>{{ $task->point->address }}</td>
                            <td>{{ $task->client->phone }}</td>
                            <td>{{ $task->comment }}</td>
                            <td>{{ $task->is_completed ? 'Xa' : 'Yo\'q'}}</td>
                            <td>{{ $task->service_cost_sum }}</td>
                            <td>
                                <span style="font-weight: bold">{{ $task->product_cost_sum }}</span> <br>
                                {!! $task->showProducts() !!}
                            </td>
                            <td>{{ $task->service_time }}</td>
                            <td>
                                <div class="d-flex">

                                    @if($task->status == \App\Models\Task::COMPLETED)
                                     @include('agents.tasks.confirm')
{{--                                     @include('agents.tasks.index')--}}
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Ma'lumot yo'q</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="card-body">
                    {{ $tasks->links('pagination::bootstrap-5') }}
                </div>
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
