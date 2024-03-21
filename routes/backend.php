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
use App\Http\Controllers\Backend\DriveFeeController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {

    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/logistics', [HomeController::class, 'logistics'])->name('logistics');
    Route::get('/hr', [HomeController::class, 'hr'])->name('hr');

    // Report
    Route::get('{type}/report', [ReportController::class, 'index'])->name('report');
    Route::get('{type}/report/{report}', [ReportController::class, 'show'])->name('report.show');

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
    Route::resource('{type}/{status}/track',TrackController::class);
    Route::get('{type}/arrival-track/{track}/edit',[TrackController::class, 'arrivalEdit'])->name('arrival.edit');
    Route::patch('{type}/arrival-track/{track}',[TrackController::class, 'arrivalUpdate'])->name('arrival.update');

    //Drive Fee
    Route::get('fee/driver',[DriveFeeController::class, 'driver'])->name('fee.driver');
    Route::get('fee/driver/{driver_id}',[DriveFeeController::class, 'driverDetail'])->name('fee.driver.detail');
    Route::get('fee/driver/{track_id}/edit',[DriveFeeController::class, 'driverEdit'])->name('fee.driver.edit');
    Route::put('fee/driver/{driver_track}/update',[DriveFeeController::class, 'driverUpdate'])->name('fee.driver.update');

    //Spare Fee
    Route::get('fee/spare',[DriveFeeController::class, 'spare'])->name('fee.spare');
    Route::get('fee/spare/{spare_id}',[DriveFeeController::class, 'spareDetail'])->name('fee.spare.detail');
    Route::get('fee/spare/{track_id}/edit',[DriveFeeController::class, 'spareEdit'])->name('fee.spare.edit');
    Route::put('fee/spare/{spare_track}/update',[DriveFeeController::class, 'spareUpdate'])->name('fee.spare.update');

    // Logout
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});

