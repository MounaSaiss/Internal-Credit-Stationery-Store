<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/AdminStatdashboard', function () {
    return view('dashboard');
});

  