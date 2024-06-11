<?php

declare(strict_types=1);

use App\Infrastructure\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('base');
