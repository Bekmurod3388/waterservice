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


                @include('filters.create')


            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Filter nomi</th>
                        <th>Narxi</th>
                        <th>Ko'proq</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($filters as $filter)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $filter->name }}</td>
                            <td>{{ $filter->cost }}</td>
                            <td>
                                <div class="d-flex">

                                    @include('filters.edit')

                                    <form method="POST" action="{{route('filters.destroy',$filter->id)}}">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger me-2"
                                        >
                                            <i class="bx bx-trash-alt"></i>
                                        </button>

                                    </form>
                                </div>
                            </td>
                            @empty
                                <td colspan="4" class="text-center">Ma'lumot yo'q</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
