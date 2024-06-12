<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $data['header_title'] = "Admin User Lists"; 
        $data['users'] = User::with('subscriptions')->where('user_type', 3)->get();
        
        return view('Admin.adminuserlist', $data);
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('Admin.adminuserlist')->with('success', 'User deleted successfully');

    }
    

    public function staff()
    {
        $data['header_title'] = "Admin Staff Lists"; 
        $data['staff'] = User::where('user_type', 2)->get();
        return view('Admin.adminstafflist', $data);
    }

    public function destroyStaffMember(User $staffMember)
    {
        $staffMember->delete();
        return redirect()->route('Admin.adminstafflist')->with('success', 'Staff member deleted successfully');
    }

    public function edit(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:11',
            'email' => 'required|email|max:255',
            // Add other validation rules as necessary
        ]);

        $user->update($request->all());

        return redirect()->route('Admin.adminuserlist')->with('success', 'User updated successfully');
    }

    public function editStaffMember(User $staffMember)
    {
        return response()->json($staffMember);
    }

    public function updateStaffMember(Request $request, User $staffMember)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // Add other validation rules as necessary
        ]);
    
        $staffMember->update($request->all());
    
        return redirect()->route('Admin.adminstafflist')->with('success', 'Staff member updated successfully');
    }
}    