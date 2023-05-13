<?php

use App\Http\Controllers\ArticleApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

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



Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::middleware('auth:api')->group(function() {
        Route::get('/', [AuthController::class, 'index']);
        Route::get('/user', function () {
            return Auth::user();
        });
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/article', [ArticleApiController::class, 'index']);
        Route::get('/article/{id}', [ArticleApiController::class, 'show']);
        Route::post('/article', [ArticleApiController::class, 'store']);
        Route::put('/article/{article}', [ArticleApiController::class, 'update']);
        Route::delete('/article/{article}', [ArticleApiController::class, 'destroy']);
    });
    // tambahkan rute API lainnya di sini
});
