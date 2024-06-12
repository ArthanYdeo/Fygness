<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function showCheckInForm()
    {
        // Fetch only users with user_type 3
        $data['header_title'] = "Attendance";
        $users = User::where('user_type', 3)->get();
        return view('staff.staffcheckin',$data, compact('users'));
    }

    public function checkIn(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $attendance = new Attendance();
        $attendance->user_id = $request->user_id;
        $attendance->date = now()->toDateString();
        $attendance->save();

        return redirect()->route('attendance.checkin.form')->with('success', 'User checked in successfully.');
    }
}
