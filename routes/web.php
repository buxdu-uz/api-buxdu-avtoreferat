<?php

use App\Http\Controllers\Hemis\HemisController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//oAuth2
Route::get('/auth/hemis', [HemisController::class, 'redirectToProvider']);
Route::get('/callback', [HemisController::class, 'handleCallback']);
