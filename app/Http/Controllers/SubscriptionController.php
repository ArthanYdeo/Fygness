<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Gym;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
{
    $gyms = Gym::all();
    $data['header_title'] = "Subscription";
    
    // Check if the user has an active subscription
    $hasActiveSubscription = Subscription::where('user_id', auth()->id())
        ->where('status', 'active')
        ->whereDate('end_date', '>=', now()->toDateString())
        ->exists();

    // Check if the user has a pending subscription
    $hasPendingSubscription = Subscription::where('user_id', auth()->id())
        ->where('status', 'pending')
        ->exists();

    return view('User.usersub',$data, compact('gyms', 'hasActiveSubscription', 'hasPendingSubscription'));
}


    public function hasActiveSubscription()
    {
        return Subscription::where('user_id', auth()->id())
            ->where('status', 'active')
            ->whereDate('end_date', '>=', now()->toDateString())
            ->exists();
    }

    public function hasPendingSubscription()
    {
        return Subscription::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->whereDate('end_date', '>=', now()->toDateString())
            ->exists();
    }


    public function store(Request $request)
{
    $request->validate([
        'subscription_type' => 'required|in:Basic1Month-1,Basic3Months-3,Basic5Months-5',
        'gymname' => 'required',
    ]);

    // Define subscription prices based on duration
    $prices = [
        'Basic1Month-1' => 300,
        'Basic3Months-3' => 500,
        'Basic5Months-5' => 750,
    ];

    // Extract subscription type and duration from the input value
    [$type, $duration] = explode('-', $request->subscription_type);

    // Calculate the end date based on the duration
    $endDate = now()->addMonths((int)$duration)->toDateString();

    // Check if the user already has an active subscription
    $existingSubscription = Subscription::where('user_id', auth()->id())->where('status', 'Active')->first();
    if ($existingSubscription) {
        // Cancel the existing subscription
        $existingSubscription->status = 'Cancelled';
        $existingSubscription->save();
    }

    // Save the new subscription information in the database
    $subscription = new Subscription();
    $subscription->user_id = auth()->id();
    $subscription->subscription_type = $type;
    $subscription->duration = $duration . ' Month(s)';
    $subscription->price = $prices[$request->subscription_type];
    $subscription->end_date = $endDate;
    $subscription->gymname = $request->input('gymname'); // Store gymname instead of gym_id
    $subscription->status = 'Pending'; // Set status to Active for a new subscription
    $subscription->save();

    ActivityLog::create([
        'user_id' => Auth::id(),
        'action' => 'create subscription',
    ]);

    return redirect()->route('profile.index')->with('success', 'Subscription created successfully. Please pay at the gym to activate.');
}


}
