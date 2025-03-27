<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\AuthController;

// Route xác thực (không cần đăng nhập)
Route::get('login', [AuthController::class, 'getLogin'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('auth.login.post');
Route::post('logout', [AuthController::class, 'getLogout'])->name('admin.logout');
Route::get('password/reset', [AuthController::class, 'getReset'])->name('auth.reset');
Route::post('password/reset', [AuthController::class, 'postReset'])->name('auth.reset.post');

// Route cần xác thực
Route::middleware('auth:api')->group(function () {
    // Các route cần đăng nhập
});
