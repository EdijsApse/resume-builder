<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserProfile as UserProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $hasProfile = $user->profile()->exists();

        $validationRules = [
            'name' => 'required',
            'surname' => 'required',
            'occupation' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'professional_summary' => 'required'
        ];

        $messages = [
            'name.required' => __('messages.validation.required'),
            'surname.required' => __('messages.validation.required'),
            'occupation.required' => __('messages.validation.required'),
            'phone.required' => __('messages.validation.required'),
            'address.required' => __('messages.validation.required'),
            'professional_summary.required' => __('messages.validation.required'),
            'website.url' => __('messages.validation.url'),
            'image.image' => __('messages.validation.image'),
            'image.mimes' => __('messages.validation.mimes', ['types' => 'jpeg,png,jpg']),
        ];

        $userProfile = [
            'name' => $request->post('name'),
            'surname' => $request->post('surname'),
            'occupation' => $request->post('occupation'),
            'phone' => $request->post('phone'),
            'address' => $request->post('address'),
            'professional_summary' => $request->post('professional_summary'),
        ];

        if ($request->post('website')) {
            $validationRules['website'] = 'url';
            $userProfile['website'] = $request->post('website');
        }

        if (!$hasProfile || $request->file('image')) {
            $validationRules['image'] = 'image|mimes:jpeg,png,jpg';
        }

        $validator = Validator::make($request->post(), $validationRules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        
        if ($request->file('image')) {
            $file = Storage::disk('public')->put($user->getPhotoStoragePath(), $request->file('image'));
            $userProfile['photo'] = Storage::url($file);
        }

        $profile = $user->profile()->updateOrCreate(
            [
                'user_id' => $user->id
            ],
            $userProfile
        );

        return response()->json([
            'success' => true,
            'profile' => new UserProfileResource($profile)
        ]);
    }

    /**
     * Return user profile resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) {
        $user = $request->user();
        $profile = $user->profile;
        $profileResource = null;

        if ($profile) {
            $profileResource = new UserProfileResource($profile);
        }

        return response()->json([
            'profile' => $profileResource
        ]);
    }
}
