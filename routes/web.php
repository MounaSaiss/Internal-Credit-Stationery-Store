<?php

use App\Http\Controllers\AdminDashController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\OrderController;
use App\Http\Controllers\Manager\OrderController as ManagerOrderController;

Route::get('/', function () {
    return view('welcome');
});
//we should separate the models to independent entities like Admin, Manager and Employee
Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::get('/user/purchases', [UserController::class, 'purchases'])->name('user.purchases');
Route::get('/user/orders', [UserController::class, 'orders'])->name('user.orders');
Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/AdminStatdashboard', [AdminDashController::class, 'ViewAdmindash'])->name('dashboard');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}/delete', [ProductController::class, 'delete'])->name('products.destroy');
});

Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/orders/waiting', [ManagerOrderController::class, 'waiting'])->name('orders.waiting');
    Route::post('/orders/{id}/approve', [ManagerOrderController::class, 'approve'])->name('orders.approve');
    Route::post('/orders/{id}/reject', [ManagerOrderController::class, 'reject'])->name('orders.reject');
});

    
