<?php

use App\Http\Controllers\AuthController;
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

Route::group([
    'middleware' => [
        'auth:sanctum'
    ],
], function() {

    Route::post('logout', [AuthController::class, 'logout']);

    Route::group([
        'prefix' => 'user'
    ], function() {
        Route::get('/details', [UserController::class, 'details']);
    });

});
