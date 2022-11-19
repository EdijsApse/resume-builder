<?php

namespace App\Http\Controllers;

use App\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    /**
     * Generates PDF from users data
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $hash)
    {   
        $locale = $request->query('lang') ?? config('app_default_locale');
        
        App::setLocale($locale);

        $user = User::where(['hash' => $hash])->first();

        $profile = $user->profile;
        if (!$user) {
            return redirect('/');
        }
        
        $pdf = Pdf::loadView('resume-layouts.Layout-1', [
            'user' => $user,
            'profile' => $profile,
            'experiences' => $user->experiences,
            'educations' => $user->educations,
            'certificates' => $user->certificates,
            'skills' => $user->skills,
            'languages' => $user->languages()->with(['language', 'level'])->get()
        ]);

        return $pdf->download($profile->name.' '.$profile->surname.'-Resume.pdf');
    }
}
