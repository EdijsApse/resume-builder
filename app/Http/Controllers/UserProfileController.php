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

        $validator = Validator::make($request->post(), [
            'name' => 'required',
            'surname' => 'required',
            'occupation' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'website' => 'url',
            'image' => 'image|mimes:jpeg,png,jpg',
            'professional_summary' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $file = Storage::disk('public')->put($user->getPhotoStoragePath(), $request->file('image'));

        $profile = $user->profile()->create([
            'name' => $request->post('name'),
            'surname' => $request->post('surname'),
            'occupation' => $request->post('occupation'),
            'phone' => $request->post('phone'),
            'address' => $request->post('address'),
            'photo' => Storage::url($file),
            'professional_summary' => $request->post('professional_summary'),
        ]);

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
        
        return response()->json([
            'profile' => new UserProfileResource($user->profile)
        ]);
    }
}
