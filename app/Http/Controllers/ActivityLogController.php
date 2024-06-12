<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Task;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    public function index()
    {
        $data['header_title'] = "Activity Logs"; 

        // Fetch staff members with user_type equal to 2
        $staff = User::where('user_type', 2)->get();
        
        // Fetch regular users with user_type equal to 3
        $users = User::where('user_type', 3)->get();
    
        // Fetch activity logs for users with specific actions
        $userActivityLogs = ActivityLog::whereIn('user_id', $users->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Fetch activity logs for staff with specific actions
        $staffActivityLogs = ActivityLog::whereIn('user_id', $staff->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Return the view with the fetched data
        return view('Admin.adminactivitylogs', $data, compact('users', 'userActivityLogs', 'staff', 'staffActivityLogs'));
    }
}
