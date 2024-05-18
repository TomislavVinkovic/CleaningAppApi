<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ListingController;
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

// Public store routes
Route::post('login', [AuthController::class, 'login']);
Route::post('company', [CompanyController::class, 'store']);
Route::post('listing', [ListingController::class, 'store']);

Route::group([
    'middleware' => [
        'auth:sanctum'
    ],
], function() {
    Route::group([
        'prefix' => 'user'
    ], function() {
        Route::get('details', [UserController::class, 'details']);
    });
    
    Route::post('logout', [AuthController::class, 'logout']);

    Route::group([
        'prefix' => 'admin'
    ], function() {
        

        Route::group([
            'prefix' => 'user'
        ], function() {
            Route::get('list', [UserController::class, 'list']);
            
            
            Route::post('{user}/verify', [UserController::class, 'verify']);
            Route::post('{user}/deactivate', [UserController::class, 'deactivate']);
            Route::post('{user}/reset-password', [UserController::class, 'resetPassword']);
            Route::get('{user}', [UserController::class, 'show']);
        });

        Route::group([
            'prefix' => 'listing'
        ], function() {
            Route::get('', [ListingController::class, 'list']);
            Route::get('{listing}', [ListingController::class, 'show']);
            Route::delete('{listing}', [ListingController::class, 'destroy']);
        });

    });

    

});
