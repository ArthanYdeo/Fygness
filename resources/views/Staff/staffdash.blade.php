@extends('layout.app')

@section('content')
<div class="container">
    
    <h2>Pending Tasks</h2>
    @if($pendingTasks->isEmpty())
        <p>No pending tasks.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Assigned To</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingTasks as $task)
                    <tr>
                        <td>{{ $task->task_name }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->user->full_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h2>Completed Tasks</h2>
    @if($completedTasks->isEmpty())
        <p>No completed tasks.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Assigned To</th>
                </tr>
            </thead>
            <tbody>
                @foreach($completedTasks as $task)
                    <tr>
                        <td>{{ $task->task_name }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->user->full_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
