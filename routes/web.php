<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Manager\OrderItemController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/AdminStatdashboard', function () {
    return view('dashboard');
});

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
Route::get('/admin/orders/waiting', [OrderItemController::class, 'waiting'])
    ->name('admin.orders.waiting');
Route::patch('/orders/{orderItem}/refuse', [OrderItemController::class, 'refuseOrder'])
    ->name('orders.refuse');
Route::patch('/orders/{orderItem}/validate', [OrderItemController::class, 'validateOrder'])
    ->name('orders.validate');
