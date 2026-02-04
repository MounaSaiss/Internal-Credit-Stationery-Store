<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});
//we should separate the models to independent entities like Admin, Manager and Employee
Route::get('/user/index', [UserController::class, 'profile'])->name('employee.profile');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
