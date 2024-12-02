<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PenayanganController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user', [AuthController::class, 'user'])->middleware(['auth:sanctum']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

// film
Route::get('/load-penayangan', [PenayanganController::class, 'load_film']);
Route::get('/detail-penayangan/{id}', [PenayanganController::class, 'detail_penayangan']);
Route::post('/beli-tiket', [PenayanganController::class, "beli_tiket"]);
Route::get('/lihat-tiket/{id}', [PenayanganController::class, 'lihat_tiket']);
