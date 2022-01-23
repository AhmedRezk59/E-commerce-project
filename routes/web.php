<?php

use App\Http\Payment\MyFatoorahPayment;
use Illuminate\Support\Facades\Route;

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


Route::get('successfulPayment', [MyFatoorahPayment::class, 'paymentCallBack']);
Route::get('failedPayment', fn () => 'failed payment');
Route::view('/admin/{any?}', 'index')->where('any', '.*');
Route::view('/{any?}', 'user')->where('any', '.*');
