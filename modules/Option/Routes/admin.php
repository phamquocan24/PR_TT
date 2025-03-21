<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\Admin\ProductController;

Route::get('options', [ProductController::class, 'index'])->name('admin.options.index');
