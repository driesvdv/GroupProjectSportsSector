<?php

use App\Http\Controllers\SportclubController;
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
Route::get('/{sportclub_name}', [SportclubController::class, 'index']);
Route::put('/{sportclub_name}', [SportclubController::class, 'update']);

//user
Route::get('/user', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'store']);
Route::patch('/user', [UserController::class, 'update']);

