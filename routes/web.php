<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\RegistrantController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SportclubController;
use App\Http\Controllers\SportSessionController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//sportclub
Route::get('/{sportclub_name}', [SportclubController::class, 'show']);
Route::put('/{sportclub_name}', [SportclubController::class, 'update']);

//user
Route::get('/user', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);
Route::put('/user', [UserController::class, 'update']);

//registrants
Route::get('/registrants/{registrant_id}', [RegistrantController::class, 'show']);
Route::post('/registrants', [RegistrantController::class, 'store']);
Route::put('/registrants/{registrant_id}', [RegistrantController::class, 'update']);

//registrations
Route::get('/registrants/{registrant_id}/registrations/{registration_id}', [RegistrationController::class, 'show']);
Route::post('/registrants/{registrant_id}/registrations', [RegistrationController::class, 'store']);
Route::put('/registrants/{registrant_id}/registrations', [RegistrationController::class, 'update']);

//groups
Route::get('/groups/{group_name}', [GroupController::class, 'show']);
Route::post('/groups', [GroupController::class, 'store']);
Route::put('/groups/{group_name}', [GroupController::class, 'update']);

//sportsessions
Route::get('/sportsession/{session_id}', [SportSessionController::class, 'show']);
Route::post('/sportsessions', [SportSessionController::class, 'store']);
Route::put('/sportsessions/{session_id}', [SportSessionController::class, 'update']);

//absentsessions
Route::get('/sportsessions/{session_id}/absentsessions', [SportSessionController::class, 'index']);
Route::get('/sportsessions/{session_id}/absentsessions/{absent_id}', [SportSessionController::class, 'show']);
Route::post('/sportsessions/{session_id}/absentsessions', [SportSessionController::class, 'store']);
Route::put('/sportsessions/{session_id}/absentsessions/{absent_id}', [SportSessionController::class, 'update']);
