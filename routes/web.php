<?php

use App\Http\Controllers\API\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\AdminDataJob;
use App\Http\Livewire\Admin\JobController as Job;
use App\Http\Livewire\Admin\AppyController as Apply;
use App\Http\Livewire\CrudGenerator;

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
// Route::get('/register', function () {
//     return redirect("register");
// });



Route::group(['middleware' => ['admin', 'auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/job', Job::class)->name('job');
    Route::get('/apply', Apply::class)->name('apply');
    Route::get('/crud-generator', CrudGenerator::class)->name('crud.generator');
});
