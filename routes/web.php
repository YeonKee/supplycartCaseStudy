<?php

use App\Http\Controllers\LogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('user.login');
});

// User
Route::get('/users/registerPage', [UserController::class, 'create']);
Route::post('/users/register', [UserController::class, 'store']);
Route::get('/users/loginPage', [UserController::class, 'loginPage']);
Route::post('/users/login', [UserController::class, 'login']);
Route::get('/users/logout', [UserController::class, 'logout']);

// User Email Verification
Route::get('/updateDatabaseEmailVerification/{userID}', [UserController::class, 'updateEmailVerification'])->name('update.database.verifyEmail');
Route::get('/verifyEmail/{email}/{userID}', [MailController::class, 'verifyEmail'])->name('verifyEmail');
Route::get('/resentVerifyEmail/{email}/{userID}', [MailController::class, 'resentVerifyEmail'])->name('resentVerifyEmail');
Route::get('/users/pendingEmailVerify', function () {
    return view('user.pendingEmailVerify');
});
Route::get('/users/successEmailVerify', function () {
    return view('user.successEmailVerify');
});

// Product
Route::get('/products/index', [ProductController::class, 'index']);
Route::get('/products/create', [ProductController::class, 'create']);
Route::get('/products/sort', [ProductController::class, 'sort']);
Route::post('/products/store', [ProductController::class, 'store']);

// Order
Route::get('/users/orders/index', [OrderController::class, 'index']);
Route::post('/users/orders/store', [OrderController::class, 'store']);
Route::get('/users/orders/cart', [OrderController::class, 'cart']);
Route::post('/users/orders/checkout', [OrderController::class, 'checkout']);
Route::get('/users/orders/viewOrderDetail/{id}', [OrderController::class, 'show']);

// Order_Product
Route::delete('/users/orders/cart/deleteItem/{id}', [OrderController::class, 'deleteItem']);

// Logs
Route::get('/users/logs/index', [LogController::class, 'index']);
