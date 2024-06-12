<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Task;
use App\Models\Announcement;
use App\Models\Gym;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = "Dashboard";

        if (Auth::user()->user_type == 1) {
            // Admin Dashboard
            $data['getUser'] = User::getUser();
            $data['getStaff'] = User::getStaff();
            $data['announcements'] = Announcement::latest()->paginate(10);
            $data['header_title'] = "Admin Dashboard";
            $data['getTrainer'] = User::getTrainer(); 
            $data['totalGyms'] = Gym::count();
            return view('Admin.admindash', $data);
        } 
        elseif(Auth::user()->user_type == 2){
            // Staff Dashboard
            $data['header_title'] = "Staff Dashboard";
            $data['getUser'] = User::getUser();
            // Fetch tasks created by users (user_type = 3)
            $data['pendingTasks'] = Task::whereHas('user', function($query) {
                $query->where('user_type', 3);
            })->where('status', 'pending')->get();
            $data['completedTasks'] = Task::whereHas('user', function($query) {
                $query->where('user_type', 3);
            })->where('status', 'done')->get();
            return view('Staff.staffdash', $data);
        }
        elseif (Auth::user()->user_type == 3) {
            // User Dashboard
            $data['header_title'] = "User Dashboard";
            $userId = Auth::id();
            $tasks = Task::where('user_id', $userId)->get();
            $announcements = Announcement::latest()->paginate(10); // Fetch announcements
            return view('User.userdash', $data, compact('tasks', 'announcements'));
        }
    }
}
