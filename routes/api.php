<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', 'AuthController@refreshUser');
    
    Route::post('profile', 'UserProfileController@store');
    Route::get('profile', 'UserProfileController@show');

    Route::get('/experiences', 'ExperienceController@index');
    Route::post('/experience', 'ExperienceController@store');
    Route::post('/experience/{id}', 'ExperienceController@update');
    Route::delete('/experience/{id}', 'ExperienceController@destroy');

    Route::get('/education', 'EducationController@index');
    Route::post('/education', 'EducationController@store');
    Route::post('/education/{id}', 'EducationController@update');
    Route::delete('/education/{id}', 'EducationController@destroy');

    Route::get('/certificates', 'CertificateController@index');
    Route::post('/certificates', 'CertificateController@store');
    Route::post('/certificate/{id}', 'CertificateController@update');
    Route::delete('/certificate/{id}', 'CertificateController@destroy');

    Route::get('/resume-languages', 'ResumeLanguageController@index');
    Route::post('/resume-language', 'ResumeLanguageController@store');
    Route::post('/resume-language/{id}', 'ResumeLanguageController@update');
    Route::delete('/resume-language/{id}', 'ResumeLanguageController@destroy');

    Route::get('/skills', 'SkillsController@index');
    Route::post('/skills', 'SkillsController@store');

    Route::post('/admin/language', 'AdminController@language');
    Route::post('/admin/level', 'AdminController@level');
});

Route::get('/select-lists', 'PublicController@selectLists');

Route::post('/signup', 'AuthController@register');
Route::post('/login', 'AuthController@login');