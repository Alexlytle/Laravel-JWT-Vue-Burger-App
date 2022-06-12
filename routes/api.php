<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BurgerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
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
|
*/


Route::post('/register',[AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'loginUser'])->name('login');
Route::get('/token', [AuthController::class, 'token']);

Route::post('/submit/email', [EmailController::class, 'contactEmail']);

Route::post('/submit/burger', [BurgerController::class, 'submitBurger']);
// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/loggedIn', [AuthController::class, 'whosLoggedIn']);
    Route::resource('burger',BurgerController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/account', [AuthController::class, 'account']);

    Route::get('/each/user', [AuthController::class, 'user']);

    Route::post('/dashboard/remove/fav', [DashboardController::class, 'logout']);

    Route::post('/dashboard/update/user', [DashboardController::class, 'updateUser']);

    Route::get('/burger/each/{id}', [BurgerController::class, 'each']);
});