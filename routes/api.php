<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ApplyController;
use App\Http\Controllers\API\JobController;

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

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('apply', [ApplyController::class, 'apply']);
    Route::get('job', [JobController::class, 'index']);
    Route::get('job/{id}', [JobController::class, 'detail']);
    Route::get('apply/my-apply', [ApplyController::class, 'MyApply']);
    Route::get('apply/my-apply/{id}', [ApplyController::class, 'DetailApply']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('user/photo', [UserController::class, 'updatePhoto']);
    Route::post('logout', [UserController::class, 'logout']);
});
