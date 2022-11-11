<?php

namespace App\Http\Controllers;

use App\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Experience as ExperienceResource;
use App\Http\Resources\ExperienceCollection;

class ExperienceController extends Controller
{
    /**
     * Validates post request data
     * 
     * @return Illuminate\Support\Facades\Validator
     */
    protected function validateInputs(Request $request)
    {
        $rules = [
            'jobtitle' => 'required',
            'employer' => 'required',
            'from' => 'required|date',
            'is_current' => 'boolean',
        ];

        if ($request->post('is_current') != true) {
            $rules['to'] = 'required|date|after:from|before:+1month';
        }

        return Validator::make($request->post(), $rules, [
            'to.date' => 'Select valid date',
            'to.after' => 'Date should be greater than from date',
            'to.before' => "Date shouldn not be greater than todays date",
            'from.date' => 'Select valid date',
        ]);
    }

    protected function getAdditionalErrorMessages()
    {
        
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
            'experiences' => new ExperienceCollection($user->experiences)
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

        $exp = $user->experiences()->create($request->post());

        return response()->json([
            'success' => true,
            'experience' => new ExperienceResource($exp)
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

        $experience = Experience::where([
            'user_id' => $user->id,
            'id' => $id
        ])->first();
        
        if (!$experience) {
            return response()->json([
                'success' => false,
                'error' => 'Experience not found!'
            ], 404);
        }

        $validator = $this->validateInputs($request);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $experience->update($request->post());

        return response()->json([
            'success' => true,
            'experience' => new ExperienceResource($experience)
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
        
        $experience = Experience::where([
            'user_id' => $user->id,
            'id' => $id
        ])->first();

        if (!$experience) {
            return response()->json([
                'success' => false,
                'error' => 'Experience not found!'
            ]);
        }

        return response()->json([
            'success' => $experience->delete()
        ]);
    }
}
