<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\SoftSkills as SoftSkillsResource;
use Illuminate\Support\Facades\Validator;

class SoftSkillsController extends Controller
{

    /**
     * Display a single resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $softSkills = $user->softSkills;
        $skillsResource = null;

        if ($softSkills) {
            $skillsResource = new SoftSkillsResource($softSkills);
        }
        
        return response()->json([
            'soft_skills' => $skillsResource
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

        $validator = Validator::make($request->post(), [
            'list' => 'array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $softSkills = $user->softSkills()->updateOrCreate([ 'user_id' => $user->id], $request->post());

        return response()->json([
            'success' => true,
            'soft_skills' => new SoftSkillsResource($softSkills)
        ]);
    }
}
