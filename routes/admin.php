<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);