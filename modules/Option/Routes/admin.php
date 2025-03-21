<?php

use Illuminate\Support\Facades\Route;

use Modules\Product\Http\Controllers\Admin\ProductController;

Route::get('options', [ProductController::class, 'index'])->name('admin.options.index');

use Modules\Option\Http\Controllers\Admin\OptionController;

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

Route::get('options', [OptionController::class, 'index'])->name('admin.options.index');

Route::get('options/create', [OptionController::class, 'create'])->name('admin.options.create');

Route::post('options', [OptionController::class, 'store'])->name('admin.options.store');

Route::get('options/{id}/edit', [OptionController::class, 'edit'])->name('admin.options.edit');

Route::get('options/{id}', [OptionController::class, 'update'])->name('admin.options.update');

Route::delete('options/{ids}', [OptionController::class, 'destroy'])->name('admin.options.destroy');

Route::get('options/index/table', [OptionController::class, 'table'])->name('admin.options.table');

