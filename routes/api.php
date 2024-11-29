<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JWTAuthenticate;
/*
|---------------------------------------------------------------------------
| API Routes
|---------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them 
| will be assigned to the "api" middleware group. Make something great!
|
*/
// routes/api.php
// Route::post('/login', [AuthController::class, 'login']);

// Route::middleware([JWTAuthenticate::class])->group(function () {
//     Route::get('/index', [AuthController::class, 'showIndex']);
//     Route::get('/profile', [AuthController::class, 'showProfile']);
//     Route::post('/logout', [AuthController::class, 'logout']);
// });
