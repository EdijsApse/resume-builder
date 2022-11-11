<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Education;
use App\Http\Resources\EducationCollection;
use App\Http\Resources\Education as EducationResource;

class EducationController extends Controller
{
    /**
     * Validates post request data
     * 
     * @return Illuminate\Support\Facades\Validator
     */
    protected function validateInputs(Request $request)
    {
        $rules = [
            'school' => 'required',
            'degree' => 'required',
            'from' => 'required|date',
            'is_current' => 'boolean',
        ];

        if ($request->post('is_current') != true) {
            $rules['to'] = 'required|date|after:from|before:+1month';
        }

        return Validator::make($request->post(), $rules, [
            'to.date' => 'Select valid date',
            'to.after' => 'Date should be greater than from date',
            'to.before' => "Select date before today's date",
            'from.date' => 'Select valid date',
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
            'educations' => new EducationCollection($user->educations)
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

        $education = $user->educations()->create($request->post());

        return response()->json([
            'success' => true,
            'education' => new EducationResource($education)
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

        $education = Education::where([
            'user_id' => $user->id,
            'id' => $id
        ])->first();
        
        if (!$education) {
            return response()->json([
                'success' => false,
                'error' => 'Education record not found!'
            ], 404);
        }

        $validator = $this->validateInputs($request);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $education->update($request->post());

        return response()->json([
            'success' => true,
            'education' => new EducationResource($education)
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
        
        $education = Education::where([
            'user_id' => $user->id,
            'id' => $id
        ])->first();

        if (!$education) {
            return response()->json([
                'success' => false,
                'error' => 'Education record not found!'
            ]);
        }

        return response()->json([
            'success' => $education->delete()
        ]);
    }
}
