@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Staff Report</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Pending Members</th>
                    <th scope="col">Registered Members</th>
                    <th scope="col">Number of Announcements Created</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $report['pending_members'] }}</td>
                    <td>{{ $report['registered_members'] }}</td>
                    <td>{{ $report['number_of_announcements_created'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
