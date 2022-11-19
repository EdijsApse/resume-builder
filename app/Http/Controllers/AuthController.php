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
        $validatedDate = $request->validate(
            [
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:5',
            ],
            [
                'email.required' => __('messages.validation.required'),
                'email.unique' => __('messages.validation.unique'),
                'email.email' => __('messages.validation.email'),
                'password.required' => __('messages.validation.required'),
                'password.confirmed' => __('messages.validation.confirmed'),
                'password.min' => __('messages.validation.min', ['min_length' => 5]),
            ]
        );

        $user = User::create([
            'email' => $validatedDate['email'],
            'hash' => str_replace('/', '-', Hash::make($validatedDate['email'] . time())),
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
        $validatedDate = $request->validate(
            [
            'email' => 'required|email',
            'password' => 'required',
            ],
            [
                'email.required' => __('messages.validation.required'),
                'email.email' => __('messages.validation.email'),
                'password.required' => __('messages.validation.required'),
            ]
        );

        $user = User::firstWhere(['email' => $validatedDate['email']]);

        if (!$user || !Hash::check($validatedDate['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'error' => __('messages.alert.invalid_credentials')
            ]);
        }

        $token = $user->createToken('personal-access-token');

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token->plainTextToken,
            'success' => true
        ]);
    }

    public function refreshUser(Request $request)
    {
        return response()->json([
            'user' => new UserResource($request->user()),
        ]);
    }
}
