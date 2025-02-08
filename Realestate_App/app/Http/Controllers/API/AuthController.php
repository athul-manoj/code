<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // REGISTER
    public function register(Request $request)
    {
        
        $validator=Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'All Fields are Mandatory',
                'error' => $validator->messages(),
            ],422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // dd($user);
        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // LOGIN
    public function login(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if($validator->fails())
        {
            return response()->json([
                'message' => 'All Fields are Mandatory',
                'error' => $validator->messages(),
            ],422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(['email' => ['Invalid credentials.']]);
        }

        // Create Sanctum Token
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }

    // AUTHENTICATED USER DETAILS
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
