<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Certificate;
use App\Http\Resources\CertificateCollection;
use App\Http\Resources\Certificate as CertificateResource;

class CertificateController extends Controller
{
    /**
     * Validates post request data
     * 
     * @return Illuminate\Support\Facades\Validator
     */
    protected function validateInputs(Request $request)
    {
        $rules = [
            'name' => 'required',
            'organization' => 'required',
            'issued' => 'required|date|before:+1month',
        ];

        return Validator::make($request->post(), $rules, [
            'issued.before' => "Select date before today's date"
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
            'certificates' => new CertificateCollection($user->certificates)
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

        $certificate = $user->certificates()->create($request->post());

        return response()->json([
            'success' => true,
            'certificate' => new CertificateResource($certificate)
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

        $certificate = Certificate::where([
            'user_id' => $user->id,
            'id' => $id
        ])->first();
        
        if (!$certificate) {
            return response()->json([
                'success' => false,
                'error' => 'Certificate record not found!'
            ], 404);
        }

        $validator = $this->validateInputs($request);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $certificate->update($request->post());

        return response()->json([
            'success' => true,
            'certificate' => new CertificateResource($certificate)
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
        
        $certificate = Certificate::where([
            'user_id' => $user->id,
            'id' => $id
        ])->first();

        if (!$certificate) {
            return response()->json([
                'success' => false,
                'error' => 'Certificate record not found!'
            ]);
        }

        return response()->json([
            'success' => $certificate->delete()
        ]);
    }
}
