<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TradesController;
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

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'signup']);

Route::get('/proUsers', [UserController::class, 'getProUsers']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [UserController::class, 'getUserInfo']);
    Route::patch('/user', [UserController::class, 'updateUserInfo']);
    Route::get('/transactions', [TransactionsController::class, 'getUserTransactions']);
    Route::get('/transactions/deposits', [TransactionsController::class, 'getUserDepositTransactions']);
    Route::post('/transactions', [TransactionsController::class, 'createTransaction']);
    Route::post('/updateDeposit/{id}', [TransactionsController::class, 'updateDeposit']);
    Route::post('/trade', [TradesController::class, 'startTrade']);
    Route::put('/trade/{id}', [TradesController::class, 'endTrade']);
    Route::get('/trade', [TradesController::class, 'getUserTrades']);
});

Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/register', [AdminController::class, 'signup']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'getAllUsers']);
    Route::get('/admin/prousers', [UserController::class, 'getProUsers']);
    Route::get('/admin/stats', [AdminController::class, 'getStats']);
    Route::get('/admin/user/{id}', [UserController::class, 'getUserDetails']);
    Route::get('/admin/user/{id}/freeze', [UserController::class, 'freezeUser']);
    Route::get('/admin/user/{id}/delete', [UserController::class, 'deleteUser']);
    Route::patch('/admin/user/{id}', [UserController::class, 'updateUserDetails']);
    Route::patch('/admin/user/{id}/wallet', [UserController::class, 'updateUserWallet']);
    Route::get('/admin/transactions', [TransactionsController::class, 'getAllTransactions']);
    Route::get('/admin/settings', [SettingsController::class, 'getAllSettings']);
    Route::patch('/admin/setting', [SettingsController::class, 'updateSetting']);
});


Route::get('/assets', [AssetsController::class, 'index']);
Route::get('/assets/active', [AssetsController::class, 'activeIndex']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/assets', [AssetsController::class, 'store']);
    Route::patch('/assets/toggle/{id}', [AssetsController::class, 'toggleAsset']);
    Route::delete('asset/{id}', [AssetsController::class, 'deleteAsset']);
});
