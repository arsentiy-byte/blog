<?php

declare(strict_types=1);

use App\Infrastructure\Http\Controllers\AuthenticationController;
use App\Infrastructure\Http\Controllers\IndexController;
use App\Infrastructure\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('base');

Route::name('api-')->group(function (): void {
    Route::prefix('auth')->name('auth-')->group(function (): void {
        Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    });

    Route::middleware('auth:api')->group(function (): void {
        Route::prefix('users')->name('users-')->group(function (): void {
            Route::post('', [UserController::class, 'create'])->name('create');
            Route::put('{user}', [UserController::class, 'update'])->name('update');
            Route::delete('{user}', [UserController::class, 'delete'])->name('delete');
        });
    });
});
