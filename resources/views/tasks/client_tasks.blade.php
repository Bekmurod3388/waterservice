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

                    <button class="btn btn-primary me-2" type="submit">
                        <i class="bx bx-search"></i>
                    </button>
                </form>
                <button
                    type="button"
                    class="btn btn-secondary create-new btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#basicModal">
                    <span>
                    <i class="bx bx-plus me-sm-1"></i>
                    <span class="d-none d-sm-inline-block">malumot qo'shish test</span>
                    </span>
                </button>

                <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Ish yaratish</h5>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{route($action)}}">

                                    @csrf
                                    <div class="row g-2">
                                        <div class="col mb-3">
                                            <label for="agent_id" class="form-label">Agentlarni tanlang</label><br>
                                            <select id="agent_id" class="form-control" name="agent_id">
                                                @foreach($agents as $agent)
                                                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col mb-3">
                                            <label for="phone" class="form-label">Manzillar</label><br>
                                            @foreach($client->points as $point)
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" value="{{ $point->id }}" name="point_id">
                                                        <span class="p-1">{{ $point->address }}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col mb-3">
                                            <label for="comment" class="form-label">Izoh</label><br>
                                            <input type="text" id="comment" name="comment" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col mb-3">
                                            <label for="service_time" class="form-label">Service vaqti</label><br>
                                            <input type="datetime-local" id="service_time" name="service_time" class="form-control">
                                        </div>
                                    </div>
                                    <input type="hidden" name="client_id" value="{{$client->id}}">
                                    <input type="text">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Yopish
                                        </button>
                                        <button type="submit" class="btn btn-primary">Saqlash</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kim qo'shdi</th>
                        <th>Izoh</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($tasks as $task)
                        <tr>
                            <th>{{$task->id}}</th>
                            <th>{{$task->user->name}}</th>
                            <th>{{$task->comment}}</th>
                            <th>
                                @include('tasks.delete')
                            </th>
                        </tr>
                    @empty
                        <td colspan="6" class="text-center">Ma'lumot yo'q</td>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
