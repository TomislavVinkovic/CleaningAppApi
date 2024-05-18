<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Route::post('login', [AuthController::class, 'login']);
Route::post('company', [CompanyController::class, 'store']);

Route::group([
    'middleware' => [
        'auth:sanctum'
    ],
], function() {

    Route::post('logout', [AuthController::class, 'logout']);

    Route::group([
        'prefix' => 'user'
    ], function() {
        Route::get('list', [UserController::class, 'list']);
        Route::get('details', [UserController::class, 'details']);
        
        Route::post('{user}/verify', [UserController::class, 'verify']);
        Route::post('{user}/deactivate', [UserController::class, 'deactivate']);
        Route::post('{user}/reset-password', [UserController::class, 'resetPassword']);
        Route::get('{user}', [UserController::class, 'show']);
        
        
    });

});
