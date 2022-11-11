<?php

namespace App\Http\Controllers;

use App\Language;
use App\LanguageLevel;
use App\Http\Resources\LanguageCollection;
use App\Http\Resources\LanguageLevelCollection;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selectLists()
    {
        return response()->json([
            'languages' => new LanguageCollection(Language::get()),
            'language_levels' => new LanguageLevelCollection(LanguageLevel::get()),
        ]);
    }
}
