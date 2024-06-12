<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class LogActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Before the request is handled
        if (Auth::check()) {
            $action = 'login';
            ActivityLog::create([
                'user_id' => Auth::user()->id,
                'action' => $action,
                'role' => Auth::user()->user_type == 1 ? 'admin' : (Auth::user()->user_type == 2 ? 'staff' : 'user'),
            ]);
        }

        $response = $next($request);

        // After the request is handled
        if (Auth::check() && Auth::user()->wasRecentlyLoggedOut) {
            $action = 'logout';
            ActivityLog::create([
                'user_id' => Auth::user()->id,
                'action' => $action,
                'role' => Auth::user()->user_type == 1 ? 'admin' : (Auth::user()->user_type == 2 ? 'staff' : 'user'),
            ]);
        }

        return $response;
    }
}
