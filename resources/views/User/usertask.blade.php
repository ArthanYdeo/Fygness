@extends('layout.app')
@section('content')

<div class="container">
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-pencil"></i> </span>
                    <h5>To-Do List</h5>
                </div>
                <div class="control-group">
                    <label class="control-label">Select Task Name:</label>
                    <div class="controls">
                        <select name="task_name" id="task_name" class="form-control" required>
                            <option value="" selected disabled>Select Task Name</option>
                            @foreach($taskOptions as $taskName => $taskDetails)
                                <option value="{{ $taskName }}">{{ $taskName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Description:</label>
                    <div class="controls">
                        <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Create Task</button>
            </div>
        </div>
    </form>
</div>

@endsection
