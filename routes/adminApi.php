<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuth\LoginController;
use App\Http\Controllers\AdminAuth\ResetPasswordController;
use App\Http\Controllers\Color\ColorController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Product\FileController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Size\SizeController;
use App\Http\Controllers\Trademark\TrademarkController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Weight\WeightController;

Route::prefix('admin')->group(function () {

    Route::post('/sendmail', [ResetPasswordController::class, 'send_reset_mail']);
    Route::post('/checkToken/{token}', [ResetPasswordController::class, 'check_token']);
    Route::put('/resetpassword/{token}', [ResetPasswordController::class, 'reset']);


    Route::middleware(['guest:admin'])->group(function () {
        Route::post('/login', [LoginController::class, 'login']);
    });
    Route::middleware(['auth:admin'])->group(function () {
        Route::resource('admins', AdminController::class);
        Route::delete('admins/destroy/all', [AdminController::class, 'multi_delete']);
        Route::post('/logout', [LoginController::class, 'logout']);


        Route::resource('users', UserController::class);
        Route::delete('users/destroy/all', [UserController::class, 'multi_delete']);


        Route::resource('departments', DepartmentController::class);

        Route::put('trademarks/{id}/updateLogo', [TrademarkController::class, 'update_logo']);
        Route::delete('trademarks/destroy/all', [TrademarkController::class, 'multi_delete']);
        Route::resource('trademarks', TrademarkController::class);


        Route::delete('colors/destroy/all', [ColorController::class, 'multi_delete']);
        Route::resource('colors', ColorController::class);

        Route::delete('sizes/destroy/all', [SizeController::class, 'multi_delete']);
        Route::resource('sizes', SizeController::class);

        Route::delete('weights/destroy/all', [WeightController::class, 'multi_delete']);
        Route::resource('weights', WeightController::class);

        Route::post('products/files', [FileController::class, 'upload_file']);
        Route::post('products/file/{id}/upload', [FileController::class, 'upload_file_to_product']);
        Route::delete('products/file/{name}/delete/{id}', [FileController::class, 'delete_file']);

        Route::put('products/{id}/updatePhoto', [ProductController::class, 'update_logo']);
        Route::delete('products/destroy/all', [ProductController::class, 'multi_delete']);
        Route::resource('products', ProductController::class);
        
        Route::resource('orders', OrderController::class);
    });
});
