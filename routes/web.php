<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;



Route::get('/', function () {
    return view('welcome');
});

<<<<<<<<< Temporary merge branch 1
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
=========
Route::get('/AdminStatdashboard', function () {
    return view('dashboard');
});

  
>>>>>>>>> Temporary merge branch 2
