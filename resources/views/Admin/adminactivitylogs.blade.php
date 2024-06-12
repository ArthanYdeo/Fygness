@extends('layout.app')

@section('content')
    <div class="container">
        <h1>{{ $header_title }}</h1>

        <h2>Users</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Action</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userActivityLogs as $log)
                    <tr>
                        <td>{{ $log->user->full_name }}</td>
                        <td>{{ ucfirst($log->action) }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination links for user activity logs -->
        <div class="pagination">
            {{ $userActivityLogs->links() }}
        </div>

        <h2>Staff</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Staff</th>
                    <th>Action</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staffActivityLogs as $log)
                    <tr>
                        <td>{{ $log->user->full_name }}</td>
                        <td>{{ ucfirst($log->action) }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination links for staff activity logs -->
        <div class="pagination">
            {{ $staffActivityLogs->links() }}
        </div>
    </div>
@endsection
