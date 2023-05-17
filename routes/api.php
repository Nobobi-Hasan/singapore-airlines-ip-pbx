<?php

use App\Http\Controllers\Admin\AdminController;
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

Route::get('/asteric/users', [AdminController::class, 'getAsterisUsers'])->name('getAsterisUsers');
Route::get('/asteric/avg', [AdminController::class, 'getAverageCallTimeOfAgent'])->name('getAverageCallTimeOfAgent');
Route::get('/asteric/abn', [AdminController::class, 'getAverageCallAbandonment'])->name('getAverageCallAbandonment');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
