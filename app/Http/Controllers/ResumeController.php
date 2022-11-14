<?php

namespace App\Http\Controllers;

use App\User;
use Barryvdh\DomPDF\Facade\Pdf;

class ResumeController extends Controller
{
    /**
     * Generates PDF from users data
     *
     * @return \Illuminate\Http\Response
     */
    public function index($hash)
    {
        $user = User::where(['hash' => $hash])->first();

        if (!$user) {
            return redirect('/');
        }
        
        $pdf = Pdf::loadView('resume-layouts.Layout-1', [
            'user' => $user,
            'profile' => $user->profile,
            'experiences' => $user->experiences,
            'educations' => $user->educations,
            'certificates' => $user->certificates,
            'skills' => $user->skills,
            'languages' => $user->languages()->with(['language', 'level'])->get()
        ]);

        return $pdf->download('invoice.pdf');
    }
}
