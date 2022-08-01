<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ObstacleController;
use App\Http\Middleware\BasicAuthentication;

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

// User Routes
Route::post('/user/new', [UserController::class, 'new'])->withoutMiddleware([BasicAuthentication::class]);
Route::post('/user/list', [UserController::class, 'list']);
Route::post('/user/update', [UserController::class, 'update']);
Route::post('/user/delete', [UserController::class, 'delete']);

// obstacles
Route::post('/obstacle/new/{user_id}/{session_code}', [ObstacleController::class, 'new']);
Route::get('/obstacle/list/{user_id}/{session_code}', [ObstacleController::class, 'list']);
Route::post('/obstacle/update/{user_id}/{session_code}', [ObstacleController::class, 'update']);
Route::post('/obstacle/delete/{user_id}/{session_code}', [ObstacleController::class, 'delete']);
// solutions
// resolutions 
