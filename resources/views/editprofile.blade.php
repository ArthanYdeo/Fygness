@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $user->full_name }}" required>
        </div>

        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        @if($user->user_type == 2)
            <div class="form-group">
                <label for="designation">Designation</label>
                <select class="form-control" id="designation" name="designation">
                    <option value="Counter" {{ $user->designation == 'Counter' ? 'selected' : '' }}>Counter</option>
                    <option value="Gym Trainer" {{ $user->designation == 'Gym Trainer' ? 'selected' : '' }}>Gym Trainer</option>
                </select>
            </div>
        @endif

        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
            @if($user->profile_picture)
                <div class="mt-2">
                    <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture" class="img-thumbnail" style="width: 150px;">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
