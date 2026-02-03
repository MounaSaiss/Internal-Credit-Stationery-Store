<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
//we should separate the models to independent entities like Admin, Manager and Employee
Route::get('/user/index', [UserController::class, 'profile'])->name('employee.profile');
