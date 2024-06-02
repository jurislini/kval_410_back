<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
{
    // Validate request data
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    // Create a new user
    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => $validatedData['password'],
    ]);

    // Issue a token for the newly registered user
    $token = $user->createToken('authToken')->plainTextToken;

    // Return token and user data
    return response()->json(['token' => $token, 'user' => $user]);
}

public function login(Request $request)
{
    // Validate login request
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($credentials)) {
        return response()->json([
            'success' => false,
            'message' => 'Email or password is incorrect'
        ], 401);
    }

    $user = Auth::user();
    $token = $user->createToken($user->email)->plainTextToken;
    return response()->json(['token' => $token, 'user' => $user]);

    // Attempt to authenticate user
    // $user = User::where('email', $credentials['email'])->first();

    // if ($user && $user->password === $credentials['password']) {
    //     $token = $user->createToken('authToken')->plainTextToken;
    //     return response()->json(['token' => $token, 'user' => $user]);
    // } else {
    //     // Authentication failed
    //     throw ValidationException::withMessages([
    //         'email' => ['The provided credentials are incorrect.'],
    //     ]);
    // }
}}

// public function login(Request $request)
// {
//     // Validate login request
//     $credentials = $request->validate([
//         'email' => 'required|email',
//         'password' => 'required',
//     ]);

//     // Attempt to authenticate user
//     if (Auth::attempt($credentials)) {
//         // Retrieve authenticated user
//         $user = Auth::user();
//         // Issue a new token for the authenticated user
//         $token = $user->createToken('authToken')->plainTextToken;
//         // Return token and user data
//         return response()->json(['token' => $token, 'user' => $user]);
//     } else {
//         // Authentication failed
//         return response()->json(['error' => 'Unauthorized'], 401);
//     }
// }}