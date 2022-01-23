<?php

use App\Http\Controllers\UserAuth\ResetPasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Trademark\TrademarkController;
use App\Http\Controllers\UIController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UserAuth\LoginController;
use App\Http\Payment\PaymentFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/get/products', [UIController::class, 'get_products']);
Route::get('/get/product/{id}', [UIController::class, 'get_product']);
Route::get('/related/products/{department_id}', [UIController::class, 'get_related_products']);
Route::get('/trademarks', [TrademarkController::class, 'index']);
Route::get('/departments', [DepartmentController::class, 'index']);

Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [LoginController::class, 'login']);

Route::post('/sendmail', [ResetPasswordController::class, 'send_reset_mail']);
Route::post('/checkToken/{token}', [ResetPasswordController::class, 'check_token']);
Route::put('/resetpassword/{token}', [ResetPasswordController::class, 'reset']);

Route::middleware(['auth:users'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::resource('/cart', CartController::class);

    Route::post('/pay', [PaymentFactory::class, 'redirect']);
    Route::put('users/edit/{id}', [UserController::class , 'update']);
    Route::get('orders', [UIController::class , 'get_orders']);
    
});
