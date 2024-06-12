@extends('layout.app')

@section('content')

<div class="container">
    <div class="tasks-list" style="text-align: center;">
        <h3>Tasks</h3>
        @if($tasks->isEmpty())
            <p>No tasks available.</p>
        @else
            <table class="table table-bordered" style="width: 80%; margin: 0 auto;">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->task_name }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->status }}</td>
                            <td>
                                @if($task->status != 'Done')
                                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">Mark as Done</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="announcements-list" style="text-align: center;">
        <h3>Announcements</h3>
        @if($announcements->isEmpty())
            <p>No announcements available.</p>
        @else
            <table class="table table-bordered" style="width: 80%; margin: 0 auto;">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($announcements as $announcement)
                        <tr>
                            <td>{{ $announcement->title }}</td>
                            <td>{{ $announcement->content }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
