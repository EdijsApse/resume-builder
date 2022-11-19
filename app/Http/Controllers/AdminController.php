<?php

namespace App\Http\Controllers;

use App\Language;
use App\LanguageLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Language as LanguageResource;
use App\Http\Resources\LanguageLevel as LanguageLevelResource;

class AdminController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function language(Request $request)
    {
        if (!Gate::allows('update-lists')) {
            return response()->json([
                'success' => false,
                'error' => __('messages.alert.not_admin')
            ], 401);
        }

        $validator = Validator::make($request->post(),
        [
            'name' => 'required',
            'code' => 'required|unique:languages'
        ],
        [
            'name.required' => __('messages.validation.required'),
            'code.required' => __('messages.validation.required'),
            'code.unique' => __('messages.validation.unique')
        ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $lang = Language::create($request->post());

        return response()->json([
            'success' => true,
            'language' => new LanguageResource($lang)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function level(Request $request)
    {
        if (!Gate::allows('update-lists')) {
            return response()->json([
                'success' => false,
                'error' => __('messages.alert.not_admin')
            ], 401);
        }

        $validator = Validator::make($request->post(),
        [
            'name' => 'required',
            'code' => 'required|unique:language_levels'
        ],
        [
            'name.required' => __('messages.validation.required'),
            'code.required' => __('messages.validation.required'),
            'code.unique' => __('messages.validation.unique')
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $level = LanguageLevel::create($request->post());

        return response()->json([
            'success' => true,
            'level' => new LanguageLevelResource($level)
        ]);
    }
}
