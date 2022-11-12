<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Skills as SkillsResource;
use Illuminate\Support\Facades\Validator;

class SkillsController extends Controller
{

    /**
     * Display a single resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $skills = $user->skills;
        $skillsResource = null;

        if ($skills) {
            $skillsResource = new SkillsResource($user->skills);
        }
        
        return response()->json([
            'skills' => $skillsResource
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

        $skills = $user->skills()->updateOrCreate([ 'user_id' => $user->id], $request->post());

        return response()->json([
            'success' => true,
            'skills' => new SkillsResource($skills)
        ]);
    }
}
