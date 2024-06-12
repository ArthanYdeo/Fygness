<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Storage;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class ListController extends Controller
{
    public function index()
    {

        $data['header_title'] = "Staff User Lists"; 
        $hasActiveSubscription = $this->hasActiveSubscription();

        $data['users'] = User::with(['subscriptions', 'subscriptions.gym'])->where('user_type', 3)->get();
        
        return view('Staff.staffuserlist', $data, compact('hasActiveSubscription'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete user',
        ]);
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
        
    }
    

    public function trainer()
    {
        $data['header_title'] = "Trainer Lists"; 
        $data['staff'] = User::where('designation', 'Gym Trainer')->get();
        return view('Staff.trainerlist', $data);
    }
    
    public function deleteTrainer($id)
{
    $trainer = User::findOrFail($id);


    // Check if the user is a Gym Trainer
    if ($trainer->designation != 'Gym Trainer') {
        return redirect()->back()->with('error', 'User is not a trainer.');
    }

    // Delete the user's profile picture if it exists
    if ($trainer->profile_picture) {
        Storage::delete('public/profile_pictures/' . $trainer->profile_picture);
    }

    // Delete the trainer
    $trainer->delete();

    ActivityLog::create([
        'user_id' => Auth::id(),
        'action' => 'delete trainer',
    ]);

    return redirect()->route('trainer.list')->with('success', 'Trainer deleted successfully.');
}
    public function activateSubscription($subscriptionId)
{
    $subscription = Subscription::findOrFail($subscriptionId);
    $subscription->status = 'Active'; // Update status field to 'active'
    $subscription->save();

    ActivityLog::create([
        'user_id' => Auth::id(),
        'action' => 'activate subscription',
    ]);
    return redirect()->back()->with('success', 'Subscription activated successfully.');
}

private function hasActiveSubscription()
{
    return Subscription::where('user_id', Auth::id())
        ->where('status', 'Active')
        ->exists();
}
}
