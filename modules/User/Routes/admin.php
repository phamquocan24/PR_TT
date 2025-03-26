<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\AuthController;

Route::get('login', [AuthController::class, 'getLogin'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('auth.login.postLogin');
Route::get('logout', [AuthController::class, 'getLogout'])->name('auth.logout');
Route::get('password/reset', [AuthController::class, 'getReset'])->name('auth.reset');
Route::post('password/reset', [AuthController::class, 'postReset'])->name('auth.reset.postReset');

// Route cho đăng nhập và đăng xuất sử dụng JWT
Route::post('api/login', [AuthController::class, 'login']);
Route::post('api/logout', [AuthController::class, 'logout'])->middleware('auth:api');
