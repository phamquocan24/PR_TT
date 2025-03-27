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
// // Route tạm thời để kiểm tra và tạo user admin
// Route::get('/check-user', function() {
//     $user = \Modules\User\Entities\User::where('email', 'admin@example.com')->first();
//     dd($user);
// });

// Route::get('/create-admin', function() {
//     $user = \Modules\User\Entities\User::updateOrCreate(
//         ['email' => 'admin@example.com'],
//         [
//             'first_name' => 'Admin',
//             'last_name' => 'User',
//             'password' => \Illuminate\Support\Facades\Hash::make('password123'),
//             'role' => 1, // Giả sử 1 là role Admin
//         ]
//     );

//     return "Admin created/updated: " . $user->email;
// });
// // Thêm vào routes/web.php
// Route::get('/test-login', function() {
//     $credentials = [
//         'email' => 'admin@example.com',
//         'password' => 'password123'
//     ];

//     if (auth('api')->attempt($credentials)) {
//         return "Đăng nhập thành công! User ID: " . auth('api')->user()->id;
//     } else {
//         return "Đăng nhập thất bại";
//     }
// });
// Trong routes/web.php
// Route::get('/test-redirect', function() {
//     return redirect()->route('admin.dashboard.index');
// });
