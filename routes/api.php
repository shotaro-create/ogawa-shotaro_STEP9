<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// 認証用ルート
Route::post('/login', [AuthController::class, 'login']);

// 認証が必要なルート（auth:sanctumミドルウェアで保護）
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/purchase', [ProductController::class, 'purchase']);
});