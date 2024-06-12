<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'subscription_type',
        'duration',
        'price',
        'end_date',
        'status',
        'gymname', // Add gymname to the fillable attributes
    ];

    // Define the relationship between users and subscriptions
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
}
