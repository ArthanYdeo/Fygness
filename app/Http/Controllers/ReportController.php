<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Announcement;
use App\Models\Subscription;

class ReportController extends Controller
{
    public function userReport()
    {
        $data['header_title'] = "User Report"; 
        $user = auth()->user();
    
        $report = [
            'profile_details' => $user,
            'subscription_plan_details' => $user->active_subscription,
            'number_of_attendances' => $user->attendances->count(),
        ];
    
        return view('reports.user', $data, ['userReport' => $report]);
    }
    

    public function staffReport()
    {
        $data['header_title'] = "Staff Report"; 
        $pendingMembers = Subscription::where('status', 'Pending')->count();
        $registeredMembers = Subscription::where('status', 'Active')->count();
        $announcements = Announcement::count();

        $report = [
            'pending_members' => $pendingMembers,
            'registered_members' => $registeredMembers,
            'number_of_announcements_created' => $announcements,
        ];

        return view('reports.staff',$data, ['report' => $report]);
    }
}