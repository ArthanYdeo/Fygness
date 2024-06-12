<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function index()
    { // Define the task options array
        $taskOptions = [
            'Push-ups' => [
                'taskName' => 'Do push-ups.',
                'status' => 'Pending',
            ],
            'Squats' => [
                'taskName' => 'Do squats.',
                'status' => 'Pending',
            ],
            'Pull-ups' => [
                'taskName' => 'Do pull-ups.',
                'status' => 'Pending',
            ],
            // Add more tasks as needed
        ];
    
        // Fetch tasks associated with the authenticated user
        $tasks = auth()->user()->tasks;
        $data['header_title'] = "Create Task"; 
    
        return view('User.usertask',$data,compact('tasks', 'taskOptions'));
    }

    public function store(Request $request)
{
    $request->validate([
        'task_name' => 'required',
        'description' => 'required',
    ]);

    $taskOptions = [
        'Push-ups' => [
            'task_name' => 'Do push-ups.',
            'status' => 'Pending',
        ],
        'Squats' => [
            'task_name' => 'Do squats.',
            'status' => 'Pending',
        ],
        'Pull-ups' => [
            'task_name' => 'Do pull-ups.',
            'status' => 'Pending',
        ],
        // Add more tasks as needed
    ];

    $taskName = $request->input('task_name');
    
    // Check if the task name exists in the task options
    if (!array_key_exists($taskName, $taskOptions)) {
        return redirect()->route('tasks.index')->with('error', 'Invalid task name.');
    }

    $task = new Task();
    $task->task_name = $taskOptions[$taskName]['task_name'];
    $task->description = $request->input('description');
    $task->status = $taskOptions[$taskName]['status'];

    // Associate the task with the authenticated user
    auth()->user()->tasks()->save($task);
    
    ActivityLog::create([
        'user_id' => Auth::id(),
        'action' => 'create task',
    ]);
    return redirect()->route('userdashboard')->with('success', 'Task created successfully.');
}

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->status = 'Done';
        $task->save();
        
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'complete task',
        ]);

        return redirect()->route('userdashboard')->with('success', 'Task marked as done.');
    }
}
