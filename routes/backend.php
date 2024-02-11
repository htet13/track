<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\IssuerController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CarNoController;
use App\Http\Controllers\Backend\DriverController;
use App\Http\Controllers\Backend\SpareController;
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
    Route::get('{type}/report', [ReportController::class, 'index'])->name('report');

    // User
    Route::resource('user', UserController::class);
    Route::get('users-export', [UserController::class, 'exportExcel'])->name('user.export');

    // Role
    Route::resource('role', RoleController::class);

    //Issuer
    Route::resource('issuer',IssuerController::class);

    //City
    Route::resource('city',CityController::class);

    //Car No
    Route::resource('car-no',CarNoController::class);

    //Driver
    Route::resource('driver',DriverController::class);

    //Spare
    Route::resource('spare',SpareController::class);

    //Track
    Route::resource('{type}/track',TrackController::class);

    // Logout
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});

