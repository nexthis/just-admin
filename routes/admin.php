<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);

Route::resource('user', \App\Http\Controllers\Admin\UserControllers::class);
Route::resource('file', \App\Http\Controllers\Admin\FileController::class);