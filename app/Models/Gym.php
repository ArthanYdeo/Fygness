<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
   
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'owner', 'address', 'phone_number', 'logo', 'inclusion'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
