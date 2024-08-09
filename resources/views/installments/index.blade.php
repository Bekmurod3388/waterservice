@extends('layouts.app')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        @include('alerts.success-alert')
        @include('alerts.error-alert')

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-column flex-sm-row">
                <form action="{{ route('installments.index') }}" method="GET"
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
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Filter narxi</th>
                        <th>Muddatli to'lov oyi</th>
                        <th>Dastlabki to'lov</th>
                        <th>Qoldiq</th>
                        <th>status</th>
                        <th>To'lov kuni</th>
                        <th>Mas'ul shaxs</th>
                        <th>Amallar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $months = [
                            '01' => 'yanvar',
                            '02' => 'fevral',
                            '03' => 'mart',
                            '04' => 'aprel',
                            '05' => 'may',
                            '06' => 'iyun',
                            '07' => 'iyul',
                            '08' => 'avgust',
                            '09' => 'sentyabr',
                            '10' => 'oktyabr',
                            '11' => 'noyabr',
                            '12' => 'dekabr',
                        ];
                    ?>
                    @forelse($installments as $val)
                        <tr>
                            <td>{{$val->id}}</td>
                            <td>{{$val->filter_cost}} so'm</td>
                            <td>{{$val->period_month}} oy</td>
                            <td>{{$val->initial_fee}} so'm</td>
                            <td>{{$val->remaining_amount}} so'm</td>
                            <td>
                                @switch($val->status)
                                    @case(\App\Models\Installments::STATUS_START)
                                        Yangi
                                        @break
                                    @case(\App\Models\Installments::STATUS_INITIAL)
                                        Muddatli to'lov
                                        @break
                                    @case(\App\Models\Installments::STATUS_CHANGE_TIME)
                                        Surilgan to'lov
                                        @break
                                    @case(\App\Models\Installments::STATUS_FINISHED)
                                        Yakunlangan
                                        @break
                                    @default
                                        Noma'lum holat
                                @endswitch
                            </td>
                            <td>{{ltrim(\Carbon\Carbon::createFromFormat('Y-m-d', $val->payment_day)->format('d'),'0')."-".$months[\Carbon\Carbon::createFromFormat('Y-m-d', $val->payment_day)->format('m')]}}</td>
                            <td>{{$val->responsible->cashier->name}}</td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-success me-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Tasdiqlash
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-warning me-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Qoldirish
                                </button>
                            </td>
                            @empty
                                <td colspan="7" class="text-center">Ma'lumot yo'q</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <!-- Basic Pagination -->
                <div class="card-body">
                    {{ $installments->links('pagination::bootstrap-5') }}
                </div>
                <!--/ Basic Pagination -->
            </div>
        </div>
    </div>

@endsection
