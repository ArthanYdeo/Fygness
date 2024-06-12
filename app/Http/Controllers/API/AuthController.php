<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
        // Authentication methods

        public function login(Request $request)
        {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:5|max:20'
            ]);
    
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('authToken')->plainTextToken;
                return response()->json(['token' => $token, 'user' => $user], 200);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }
    
        public function register(Request $request)
        {
            $request->validate([
                'full_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
            ]);
    
            $user = User::create([
                'full_name' => $request->full_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type' => 3, // Assuming this is the default user type for registration
            ]);
    
            $token = $user->createToken('authToken')->plainTextToken;
    
            return response()->json(['token' => $token, 'user' => $user], 201);
        }
    
        public function logout(Request $request)
        {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logged out successfully'], 200);
        }
    
        // CRUD methods
    
        public function getUser(Request $request)
        {
            return response()->json(['user' => $request->user()], 200);
        }
    
        public function updateUser(Request $request)
        {
            $user = $request->user();
            $user->update($request->all());
            return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
        }
    
        public function deleteUser(Request $request)
        {
            $request->user()->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
        }
    }