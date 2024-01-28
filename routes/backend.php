<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\TrackController;
use App\Http\Controllers\Backend\ReportController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {

    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Report
    Route::get('report', [ReportController::class, 'index'])->name('report');

    // User
    Route::resource('user', UserController::class);
    Route::get('users-export', [UserController::class, 'exportExcel'])->name('user.export');

    // Role
    Route::resource('role', RoleController::class);

    //City
    Route::resource('city',CityController::class);

    //Route
    Route::resource('track',TrackController::class);

    // Logout
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});

