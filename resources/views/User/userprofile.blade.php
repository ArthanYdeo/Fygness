@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h2>Your Profile</h2>

    <div>
        <div class="mt-2">
            <img src="{{ $user->profile_picture ? asset('storage/profile_pictures/'.$user->profile_picture) : asset('images/default_profile_picture.jpg') }}" alt="Profile Picture" class="img-thumbnail rounded-circle" style="width: 150px; height: 150px;">
        </div>
        <br>
        <p><strong>Name:</strong> {{ $user->full_name }}</p>
        <p><strong>Email Address:</strong> {{ $user->email }}</p>
    </div>

    <h3 class="mt-4">Subscription Plan</h3>
    @if($subscription)
        @if(now() > $subscription->end_date)
            <p>Your subscription has expired.</p>
        @else
            <p><strong>Subscribed Gym:</strong> {{ $subscription->gymname }} </p>
            <p><strong>Plan:</strong> {{ $subscription->subscription_type }}</p>
            <p><strong>Duration:</strong> {{ $subscription->duration }}</p>
            <p><strong>Expires on:</strong> {{ $subscription->end_date }}</p>
            <p><strong>Status:</strong> {{ $subscription->status }}</p>
        @endif
    @else
        <p>No subscription plan found.</p>
    @endif

    <div class="mt-4">
        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
    </div>
</div>
@endsection
