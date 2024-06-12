<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'password',
        'designation',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public static function getID($id)
    {
        return self::find($id);
    }

    // function for getting admin
    public static function getAdmin()
    {
        $query = self::query()->where('user_type', 1)->where('is_deleted', 0);
        if (!empty(Request::get('email'))) {
            $query->where('email', 'like', '%' . Request::get('email') . '%');
        }
        return $query->orderBy('id', 'desc')->paginate(10);
    }

    public static function getTrainer()
    {
        $query = self::query()
            ->whereIn('designation', ['Gym Trainer'])
            ->where('user_type', 2)
            ->where('is_deleted', 0);
        if (!empty(Request::get('email'))) {
            $query->where('email', 'like', '%' . Request::get('email') . '%');
        }
        return $query->orderBy('id', 'desc')->paginate(10);
    }

    // function for getting users
    public static function getUser()
    {
        return User::select('users.*')
                    ->where('user_type', 3)
                    ->where('is_deleted', 0)
                    ->orderBy('id', 'desc')
                    ->paginate(10);
    }

    // function for getting staff
    public static function getStaff()
    {
        $return = User::select('users.*')
                      ->where('user_type', 2)
                      ->where('is_deleted', 0);
        return $return->orderBy('id', 'desc')
                      ->paginate(10);
    }

    // Accessor for active subscription
    public function getActiveSubscriptionAttribute()
    {
        return $this->subscriptions()->where('status', 'active')->first();
    }
}
