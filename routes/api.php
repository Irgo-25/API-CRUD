<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\MakulController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    // Dosen
    Route::prefix('dosen')->group(function () {
        Route::post('/create', [DosenController::class, 'create']);
        Route::get('/read', [DosenController::class, 'read']);
        Route::put('/update/{id}', [DosenController::class, 'update']);
        Route::delete('/delete/{id}', [DosenController::class, 'delete']);
    });
    // Mahasiswa
    Route::prefix('mahasiswa')->group(function () {
        Route::post('/create', [MahasiswaController::class, 'create']);
        Route::get('/read', [MahasiswaController::class, 'read']);
        Route::put('/update/{id}', [MahasiswaController::class, 'update']);
        Route::delete('/delete/{id}', [MahasiswaController::class, 'delete']);
    });
    // Makul
    Route::prefix('makul')->group(function () {
        Route::post('/create', [MakulController::class, 'create']);
        Route::get('/read', [MakulController::class, 'read']);
        Route::put('/update/{id}', [MakulController::class, 'update']);
        Route::delete('/delete/{id}', [MakulController::class, 'delete']);
    });
});
