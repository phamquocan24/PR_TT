<?php
use Modules\User\Http\Controllers\User\UserController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::post('users/bulk-delete', [UserController::class, 'bulkDestroy'])->name('users.bulk_delete');
});
