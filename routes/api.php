<?php

use App\Http\Controllers\TransactionsController;
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
|
*/

Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getUserInfo']);

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'signup']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/transactions', [TransactionsController::class, 'getUserTransactions']);
    Route::post('/transactions', [TransactionsController::class, 'createTransaction']);
});
