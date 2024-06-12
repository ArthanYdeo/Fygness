@extends('layout.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3>Check In Users</h3>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('attendance.checkin') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="user_id">Select User</label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="" disabled selected>Select a user</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Check In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
