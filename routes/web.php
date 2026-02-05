<?php

use App\Http\Controllers\AdminDashController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/AdminStatdashboard', [AdminDashController::class, 'ViewAdmindash'])->name('dashboard');

  
