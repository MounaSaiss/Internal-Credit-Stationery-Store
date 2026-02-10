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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Manager\OrderController as ManagerOrderController;

Route::get('/', function () {
    return view('welcome');
})->name('home');
//we should separate the models to independent entities like Admin, Manager and Employee


Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{id}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}/delete', [ProductController::class, 'delete'])->name('products.destroy');
    Route::get('/dashboard/orders', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/dashboard/orders/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/AdminStatdashboard', [AdminDashController::class, 'ViewAdmindash'])->name('dashboard');
});


Route::middleware(['auth', 'role:employee,manager'])->group(function () {
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    Route::post('/cart/add{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/shop/product/{id}', [ShopController::class, 'show'])->name('shop.show');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/purchases', [UserController::class, 'purchases'])->name('user.purchases');
    Route::get('/user/orders', [UserController::class, 'orders'])->name('user.orders');
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/profile/settings', [UserController::class, 'settings'])->name('user.settings');
    Route::get('/user/orders/search/{value}', [UserController::class, 'search'])->name('user.orders');
    Route::get('/user/purchases/search/{value}', [UserController::class, 'search'])->name('user.orders');
    Route::put('/user/profile/settings/update{user}', [UserController::class, 'update'])->name('user.update');
    Route::put('/user/profile/settings/updatepass{user}', [UserController::class, 'updatepass'])->name('user.updatepass');
    Route::delete('/user/profile/settings/destroy{user}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/orders/waiting', [ManagerOrderController::class, 'waiting'])->name('orders.waiting');
    Route::post('/orders/{id}/approve', [ManagerOrderController::class, 'approve'])->name('orders.approve');
    Route::post('/orders/{id}/reject', [ManagerOrderController::class, 'reject'])->name('orders.reject');
});

Route::middleware(['auth', 'role:employee,manager,admin'])->group(function () {
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/store' , [OrderController::class , 'store'])->name('order.store');;
});

