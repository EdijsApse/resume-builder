<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Resources\User as UserResource;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedDate = $request->validate([
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:5',
        ]);

        $user = User::create([
            'email' => $validatedDate['email'],
            'password' => Hash::make($validatedDate['password']),
        ]);
        
        $token = $user->createToken('personal-access-token');

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token->plainTextToken
        ]);
    }

    public function login(Request $request)
    {
        $validatedDate = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::firstWhere(['email' => $validatedDate['email']]);

        if (!$user || !Hash::check($validatedDate['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid credentials'
            ]);
        }

        $token = $user->createToken('personal-access-token');

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token->plainTextToken
        ]);

    }
}
