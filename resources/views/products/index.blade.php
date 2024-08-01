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


                @include('products.create')


            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mahsulot nomi</th>
                        <th>Narxi</th>
                        <th>Ko'proq</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->cost }}</td>
                            <td>
                                <div class="d-flex">

                                    @include('products.edit')
                                    @include('products.delete')

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
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
                <!--/ Basic Pagination -->
            </div>
        </div>
    </div>

@endsection
