<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);

Route::resource('users', \App\Http\Controllers\Admin\UserControllers::class);