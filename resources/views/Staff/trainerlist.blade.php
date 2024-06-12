@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h2>{{ $header_title }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($staff->isEmpty())
        <p>No trainers found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staff as $trainer)
                    <tr>
                        <td>{{ $trainer->full_name }}</td>
                        <td>{{ $trainer->email }}</td>
                        <td>
                            <form action="{{ route('trainer.delete', $trainer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this trainer?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
