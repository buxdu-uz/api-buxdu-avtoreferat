<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Documents\DocumentController;
use App\Http\Controllers\Hemis\HemisController;
use App\Http\Controllers\Teachers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[LoginController::class,'login']);
Route::post('login/hemis',[HemisController::class,'checkHemisAuth'])->middleware('cors');

Route::post('register',[TeacherController::class,'store']);

Route::get('universities',[HemisController::class,'getAllUniversities']);
Route::get('faculties',[HemisController::class,'getAllFaculties']);
Route::get('departments/{faculty_id}',[HemisController::class,'getAllDepartments']);

Route::group(['middleware' => ['auth:sanctum']],function () {
    Route::post('logout', [LoginController::class, 'logout']);
    Route::get('documents',[DocumentController::class,'index']);

    Route::group(['prefix' => 'admin','middleware' => ['role:admin']],function () {
        Route::get('teachers/{department_id}',[TeacherController::class,'getAllTeacher']);
        Route::post('documents/{document}/check',[DocumentController::class,'checkDocument']);
    });

    Route::group(['prefix' => 'teacher','middleware' => ['role:teacher']],function () {
        Route::post('documents',[DocumentController::class,'store']);
    });
});


////oAuth2
Route::get('/auth/hemis', [HemisController::class, 'redirectToProvider']);
Route::get('/callback', [HemisController::class, 'handleCallback']);
