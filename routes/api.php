<?php

use App\Http\Controllers\AbsentSessionController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\RegistrantController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SportclubController;
use App\Http\Controllers\SportSessionController;
use App\Http\Controllers\UserController;
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
|we
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//sportclub
Route::get('/{sportclub_name}', [SportclubController::class, 'show']);
Route::get('/sportclubs', [SportclubController::class, 'index']);
Route::put('/{sportclub_name}', [SportclubController::class, 'update']);

//user
Route::get('/user', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store'])->middleware('auth');
Route::put('/user', [UserController::class, 'update'])->middleware('auth');

//registrants
Route::get('/registrants/{registrant_id}', [RegistrantController::class, 'show'])->middleware('auth');
Route::get('/registrants', [RegistrantController::class, 'index'])->middleware('auth');
Route::post('/registrants', [RegistrantController::class, 'store'])->middleware('auth');
Route::put('/registrants/{registrant_id}', [RegistrantController::class, 'update'])->middleware('auth');

//registrations
Route::get('/registrants/{registrant_id}/registrations/{registration_id}', [RegistrationController::class, 'show'])->middleware('auth');
Route::get('/registrants/{registrant_id}/registrations', [RegistrationController::class, 'index'])->middleware('auth');
Route::post('/registrants/{registrant_id}/registrations', [RegistrationController::class, 'store'])->middleware('auth');
Route::put('/registrants/{registrant_id}/registrations/{registration_id}', [RegistrationController::class, 'update'])->middleware('auth');

//groups
Route::get('/groups/{group_name}', [GroupController::class, 'show'])->middleware('auth');
Route::get('/groups', [GroupController::class, 'index'])->middleware('auth');
Route::post('/groups', [GroupController::class, 'store'])->middleware('auth');
Route::put('/groups/{group_name}', [GroupController::class, 'update'])->middleware('auth');

//sportsessions
Route::get('/sportsession/{session_id}', [SportSessionController::class, 'show'])->middleware('auth');
Route::post('/sportsessions', [SportSessionController::class, 'store'])->middleware('auth');
Route::put('/sportsessions/{session_id}', [SportSessionController::class, 'update'])->middleware('auth');

//absentsessions
Route::get('/sportsessions/{session_id}/absentsessions', [AbsentSessionController::class, 'index'])->middleware('auth');
Route::get('/sportsessions/{session_id}/absentsessions/{absent_id}', [AbsentSessionController::class, 'show'])->middleware('auth');
Route::post('/sportsessions/{session_id}/absentsessions', [AbsentSessionController::class, 'store'])->middleware('auth');
Route::put('/sportsessions/{session_id}/absentsessions/{absent_id}', [AbsentSessionController::class, 'update'])->middleware('auth');
