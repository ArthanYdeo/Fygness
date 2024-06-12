@extends('layout.app')
@section('content')

<h1 class="text-center">Registered Members List <i class="fas fa-users"></i></h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-16">
            <div class="card">
                <div class="card-header">User Lists</div>

                <div class="card-body">
                    <table class='table table-bordered table-hover'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>Subscribed Gym</th>
                                <th>Subscriptions</th>
                                <th>Plan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>
                                        @foreach ($user->subscriptions as $subscription)
                                            {{ $subscription->gymname }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($user->subscriptions->isEmpty())
                                            <span class="text-danger">Not subscribed</span>
                                        @else
                                            @foreach ($user->subscriptions as $subscription)
                                                {{ $subscription->subscription_type }}
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->subscriptions->isEmpty())
                                            <span class="text-danger">Not subscribed</span>
                                        @else
                                            @foreach ($user->subscriptions as $subscription)
                                                {{ $subscription->duration }}
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->subscriptions->isEmpty())
                                            <span class="text-danger">Not subscribed</span>
                                        @else
                                            @foreach ($user->subscriptions as $subscription)
                                                {{ $subscription->status }}
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @foreach ($user->subscriptions as $subscription)
                                            @if ($subscription->status !== 'Active')
                                                <form action="{{ route('subscriptions.activate', $subscription->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to activate the subscription?')"><i class='fas fa-check'></i>Activate</button>
                                                </form>
                                            @endif
                                        @endforeach
                                        <br>
                                        <br>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')"><i class='fas fa-trash'></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
