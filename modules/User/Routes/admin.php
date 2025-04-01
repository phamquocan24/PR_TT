<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\AuthController;
use Modules\User\Http\Controllers\User\UserController;
use Modules\Admin\Http\Controllers\Admin\DashboardController;

// Routes không yêu cầu đăng nhập
Route::get('login', [AuthController::class, 'getLogin'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('login.post');
Route::post('login', [AuthController::class, 'postLogin'])->name('auth.login.postLogin');
Route::get('logout', [AuthController::class, 'getLogout'])->name('logout');
Route::post('logout', [AuthController::class, 'getLogout'])->name('admin.logout.post');
Route::get('password/reset', [AuthController::class, 'getReset'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'postReset'])->name('password.reset.post');

// Routes yêu cầu đăng nhập
Route::middleware(['web'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    // Quản lý người dùng - đảm bảo đặt tên route là 'admin.users.index'
    Route::resource('users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);

    Route::post('users/bulk-delete', [UserController::class, 'bulkDestroy'])->name('admin.users.bulk_delete');

    // User Profile
    // Route::get('profile', [UserController::class, 'profile'])->name('admin.profile');
    // Route::post('profile', [UserController::class, 'updateProfile'])->name('admin.profile.update');
    // Route::post('change-password', [UserController::class, 'changePassword'])->name('admin.password.change');
});
