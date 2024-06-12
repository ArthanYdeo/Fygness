<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use App\Models\Gym;
use App\Models\ActivityLog;

class AuthController extends Controller
{
    public function loginuser()
    {
        return view("Auth.login");
    }

    public function login()
    {
        if (Auth::check()) {
            $this->logActivity('login');
            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            } elseif (Auth::user()->user_type == 2) {
                return redirect('staff/dashboard');
            } elseif (Auth::user()->user_type == 3) {
                return redirect('user/dashboard');
            }
        }

        return view('Login.login');
    }

    public function Authlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:20'
        ]);

        $remember = !empty($request->remember);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $this->logActivity('login');
            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            } elseif (Auth::user()->user_type == 2) {
                return redirect('staff/dashboard');
            } elseif (Auth::user()->user_type == 3) {
                return redirect('user/dashboard');
            }
        } else {
            // Authentication failed, redirect back with an error message
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'email' => 'Invalid credentials, please verify them and retry.',
            ]);
        }
    }


    public function registration()
    {
        return view("Auth.register");
    }

    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits:11',
            'email' => 'required|email|unique:users,email', // Unique validation rule added
            'password' => 'required|string|min:8',
        ]);

        // Check if user already exists with the given email
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return redirect()->back()->withErrors([
                'email' => 'This email is already registered.',
            ])->withInput($request->except('password', 'password_confirmation'));
        }

        // Create a new user instance
        $user = new User();
        $user->full_name = $request->full_name;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_type = 3;

        // Save the user to the database
        $user->save();
        // Log in the user
        Auth::login($user);
        $this->logActivity('register');
        return redirect("login");
    }

    public function logout()
    {
        $this->logActivity('logout');
        Auth::logout();
        return redirect(url(''));
    }

    protected function logActivity($action)
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::user()->id,
                'action' => $action,
            ]);
        }
    }

    public function showForgotPasswordForm(Request $request)
    {
        return view('auth.forgotpassword');
    }

    // Handle forgot password form submission
    public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
}


    // Show reset password form
    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // Handle reset password form submission
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function getStarted()
    {
        $gyms = Gym::all();
        return view("started", compact('gyms'));
    }

    public function selectGym()
    {
        $gyms = Gym::take(2)->get(); // Fetch only the first two gyms
        return view("selection", compact('gyms'));
    }
}

