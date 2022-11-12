<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ResumeLanguage;
use App\Http\Resources\ResumeLanguageCollection;
use App\Http\Resources\ResumeLanguage as ResumeLanguageResource;

class ResumeLanguageController extends Controller
{

    /**
     * Validates post request data
     * 
     * @return Illuminate\Support\Facades\Validator
     */
    protected function validateInputs(Request $request)
    {
        $rules = [
            'language_id' => 'required|exists:languages,id',
            'level_id' => 'required|exists:language_levels,id',
        ];

        return Validator::make($request->post(), $rules, [
            'language_id.exists' => 'Language not found!',
            'level_id.exists' => 'Language level not found!',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'languages' => new ResumeLanguageCollection($user->languages)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $validator = $this->validateInputs($request);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $language = $user->languages()->create($request->post());

        return response()->json([
            'success' => true,
            'language' => new ResumeLanguageResource($language)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();

        $language = ResumeLanguage::where([
            'user_id' => $user->id,
            'id' => $id
        ])->first();
        
        if (!$language) {
            return response()->json([
                'success' => false,
                'error' => 'Language record not found!'
            ], 404);
        }

        $validator = $this->validateInputs($request);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $language->update($request->post());

        return response()->json([
            'success' => true,
            'language' => new ResumeLanguageResource($language)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        
        $language = ResumeLanguage::where([
            'user_id' => $user->id,
            'id' => $id
        ])->first();

        if (!$language) {
            return response()->json([
                'success' => false,
                'error' => 'Language record not found!'
            ]);
        }

        return response()->json([
            'success' => $language->delete()
        ]);
    }
}
