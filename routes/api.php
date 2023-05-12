<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Controllers
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\UserController;
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



/**
 * -----------------------------------------
 * Product Module
 * -----------------------------------------
 */
Route::resource('products', ProductController::class)->except(['create', 'edit']);


/**
 * -----------------------------------------
 * Auth Module
 * -----------------------------------------
 */
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);


/**
 * -----------------------------------------
 * User Module
 * -----------------------------------------
 */
Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});
Route::resource('users', UserController::class)->except(['create', 'edit']);
