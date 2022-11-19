<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssetsController;
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
    Route::post('/updateDeposit/{id}', [TransactionsController::class, 'updateDeposit']);
});

Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/register', [AdminController::class, 'signup']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/users', [UserController::class, 'getAllUsers']);
    Route::get('/admin/user/{id}', [UserController::class, 'getUserDetails']);
    Route::patch('/admin/user/{id}', [UserController::class, 'updateUserDetails']);
    Route::patch('/admin/user/{id}/wallet', [UserController::class, 'updateUserWallet']);
    Route::get('/admin/transactions', [TransactionsController::class, 'getAllTransactions']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/assets', [AssetsController::class, 'index']);
    Route::get('/assets/active', [AssetsController::class, 'activeIndex']);
    Route::post('/assets', [AssetsController::class, 'store']);
});
