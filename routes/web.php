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

    Route::get('/add-user', [App\Http\Controllers\Admin\AddUserController::class, 'AddUser'])->name('add_user');
    Route::post('/add-user', [App\Http\Controllers\Admin\AddUserController::class, 'AddUserPost'])->name('add_user_post');

    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'GetProfile'])->name('profile');
    Route::post('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'UpdateProfile'])->name('profile_update');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/abandonment', [App\Http\Controllers\Admin\AdminController::class, 'getCallAbandonment'])->name('abandonment');
    Route::get('/abandonmentExcel', [App\Http\Controllers\Admin\ExportController::class, 'exportAbandonment'])->name('exportAbandonment');

    Route::get('/queue', [App\Http\Controllers\Admin\AdminController::class, 'getQueueTime'])->name('queue');
    Route::get('/queueExcel', [App\Http\Controllers\Admin\ExportController::class, 'exportQueue'])->name('exportQueue');

    Route::get('/queue-details-modal/{date}', [App\Http\Controllers\Admin\AdminController::class, 'queueDetailsModal'])->name('queueDetailsModal');
    Route::get('/queue-details-modal-export', [App\Http\Controllers\Admin\ExportController::class, 'exportQueueDetails'])->name('exportQueueDetails');

    Route::get('/agent', [App\Http\Controllers\Admin\AdminController::class, 'getAverageCallTimeOfAgent'])->name('agent');
    Route::get('/agentExcel', [App\Http\Controllers\Admin\ExportController::class, 'exportAgent'])->name('exportAgent');

});
