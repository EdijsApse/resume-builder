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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('profile', 'UserProfileController@store');
Route::middleware('auth:sanctum')->get('profile', 'UserProfileController@show');

Route::middleware('auth:sanctum')->get('/experiences', 'ExperienceController@index');
Route::middleware('auth:sanctum')->post('/experience', 'ExperienceController@store');
Route::middleware('auth:sanctum')->post('/experience/{id}', 'ExperienceController@update');
Route::middleware('auth:sanctum')->delete('/experience/{id}', 'ExperienceController@destroy');

Route::middleware('auth:sanctum')->get('/education', 'EducationController@index');
Route::middleware('auth:sanctum')->post('/education', 'EducationController@store');
Route::middleware('auth:sanctum')->post('/education/{id}', 'EducationController@update');
Route::middleware('auth:sanctum')->delete('/education/{id}', 'EducationController@destroy');

Route::middleware('auth:sanctum')->get('/certificates', 'CertificateController@index');
Route::middleware('auth:sanctum')->post('/certificates', 'CertificateController@store');
Route::middleware('auth:sanctum')->post('/certificate/{id}', 'CertificateController@update');
Route::middleware('auth:sanctum')->delete('/certificate/{id}', 'CertificateController@destroy');

Route::middleware('auth:sanctum')->get('/resume-languages', 'ResumeLanguageController@index');
Route::middleware('auth:sanctum')->post('/resume-language', 'ResumeLanguageController@store');
Route::middleware('auth:sanctum')->post('/resume-language/{id}', 'ResumeLanguageController@update');
Route::middleware('auth:sanctum')->delete('/resume-language/{id}', 'ResumeLanguageController@destroy');

Route::get('/select-lists', 'PublicController@selectLists');

Route::post('/signup', 'AuthController@register');
Route::post('/login', 'AuthController@login');