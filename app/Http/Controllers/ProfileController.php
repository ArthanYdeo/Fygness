<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Announcement;
use App\Models\Task;
use Hash;
use App\Models\ActivityLog; // Import the ActivityLog model
class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $data = [];

        $data['user'] = $user;
        $data['subscription'] = Subscription::where('user_id', $user->id)->first();

        if ($user->user_type == 1) {
            $data['getUser'] = User::getUser();
            $data['getStaff'] = User::getStaff();
            $data['announcements'] = Announcement::latest()->paginate(10);
            $data['header_title'] = "Admin Profile";
            return view('Admin.adminprofile', $data);
        } elseif ($user->user_type == 2) {
            $data['header_title'] = "Staff Profile";
            $data['getUser'] = User::getUser();
            return view('Staff.staffprofile', $data);
        } elseif ($user->user_type == 3) {
            $data['header_title'] = "User Profile";
            $subscriptions = Subscription::where('user_id', $user->id)->with('gym')->get();
            return view('User.userprofile', $data,compact('user', 'subscriptions'));
        }
    }


    public function edit()
    {
        $data['header_title'] = "Edit Profile";
        $user = Auth::user();
        return view('editprofile',$data, compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    // Validate the request data
    $request->validate([
        'full_name' => 'required|string|max:255',
        'password' => 'required|string|min:6',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'designation' => $user->user_type == 2 ? 'nullable|string|in:Counter,Gym Trainer' : '',
    ]);

    // Update the user's full name and password
    $user->full_name = $request->input('full_name');
    $user->password = Hash::make($request->input('password'));

    // Update the profile picture if uploaded
    if ($request->hasFile('profile_picture')) {
        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }

        $profilePicture = $request->file('profile_picture');
        $profilePictureName = time() . '.' . $profilePicture->getClientOriginalExtension();
        $path = $profilePicture->storeAs('public/profile_pictures', $profilePictureName);
        $user->profile_picture = $profilePictureName;
    }

    // Update the designation if user_type is 2
    if ($user->user_type == 2) {
        $user->designation = $request->input('designation');
    }

    // Save the updated user information
    $user->save();

    ActivityLog::create([
        'user_id' => Auth::id(),
        'action' => 'update profile',
    ]);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}