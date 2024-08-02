@extends('layouts.app')

@section('content')
    <div class="card">
        <h5 class="card-header">
            Table posts
            <a href="" class="btn btn-success float-end">Create Post</a>
        </h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>URL</th>
                    <th>Method</th>
                    <th>Payload</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td><strong>{{ $log->url }}</strong></td>
                        <td>{{ $log->method }}</td>
                        <td>{{ $log->payload }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No logs available.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $logs->links('vendor.pagination.bootstrap-5') }}
        </div>

    </div>
@endsection
