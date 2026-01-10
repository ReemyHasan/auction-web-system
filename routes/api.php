<?php

use App\Http\Controllers\V1\AdminCategoryController;
use App\Http\Controllers\V1\AdminUserController;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\PasswordResetController;
use App\Http\Controllers\V1\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
    });

    
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{id}', [CategoryController::class, 'show']);

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('my-profile', [ProfileController::class, 'myProfile']);
        Route::put('update-profile', [ProfileController::class, 'updateProfile']);

        Route::prefix('auth')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::delete('delete-account', [AuthController::class, 'deleteAccount']);

            Route::post('change-password', [PasswordResetController::class, 'changePassword']);
        });


        Route::prefix('admin')->middleware('isAdmin')->group(function () {
            Route::get('users', [AdminUserController::class, 'index']);
            Route::patch('users/{user}/role', [AdminUserController::class, 'changeRole']);
            Route::patch('users/{user}/status', [AdminUserController::class, 'toggleActivate']);


            Route::post('categories', [AdminCategoryController::class, 'store']);
            Route::put('categories/{category}', [AdminCategoryController::class, 'update']);
            Route::delete('categories/{category}', [AdminCategoryController::class, 'destroy']);
        });
    });
});
