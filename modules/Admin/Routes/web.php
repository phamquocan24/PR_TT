<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth:api']], function () {
    // Dashboard main route
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    // Dashboard API endpoints
    Route::prefix('api/dashboard')->group(function () {
        Route::get('/stats', [DashboardController::class, 'getStats']);
        Route::get('/product-prices', [DashboardController::class, 'getProductPrices']);
        Route::get('/latest-products', [DashboardController::class, 'getLatestProducts']);
        Route::get('/latest-brands', [DashboardController::class, 'getLatestBrands']);
        Route::get('/latest-users', [DashboardController::class, 'getLatestUsers']);
    });
});
