@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h1>User Report</h1>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Profile Details</th>
                <th>Subscription Plan</th>
                <th>Number of Attendances</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $userReport['profile_details']->full_name }}</td>
                <td>{{ $userReport['subscription_plan_details'] ? $userReport['subscription_plan_details']->subscription_type : 'No Active Subscription' }}</td>
                <td>{{ $userReport['number_of_attendances'] }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
