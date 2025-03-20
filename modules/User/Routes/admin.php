<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\AuthController;

Route::get('login', [AuthController::class, 'getLogin'])->name('auth.login.getLogin');

Route::post('login', [AuthController::class, 'postLogin'])->name('auth.login.postLogin');

Route::get('logout', [AuthController::class, 'getLogout'])->name('auth.logout');

Route::get('password/reset', [AuthController::class, 'getReset'])->name('auth.reset');

