<?php

use Illuminate\Support\Facades\Auth;
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
    // return view('welcome');
    return redirect('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('change_password');
    Route::post('/change-password', [App\Http\Controllers\HomeController::class, 'changePasswordPost'])->name('change_password_post');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route::get('/abandonment', [App\Http\Controllers\HomeController::class, 'abandonment'])->name('abandonment');
    Route::get('/abandonment', [App\Http\Controllers\Admin\AdminController::class, 'getCallAbandonment'])->name('abandonment');

    // Route::get('/queue', [App\Http\Controllers\HomeController::class, 'queue'])->name('queue');
    Route::get('/queue', [App\Http\Controllers\Admin\AdminController::class, 'getQueueTime'])->name('queue');

    // Route::get('/agent', [App\Http\Controllers\HomeController::class, 'agent'])->name('agent');
    Route::get('/agent', [App\Http\Controllers\Admin\AdminController::class, 'getAverageCallTimeOfAgent'])->name('agent');

});
