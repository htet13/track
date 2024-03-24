<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\IssuerController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CarNoController;
use App\Http\Controllers\Backend\TrackController;
use App\Http\Controllers\Backend\ReportController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {

    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/logistics', [HomeController::class, 'logistics'])->name('logistics');
    Route::get('/home', [HomeController::class, 'hr'])->name('home');

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

    //Track
    Route::resource('{type}/{status}/track',TrackController::class);
    Route::get('{type}/{status}/arrival-track/{track}/edit',[TrackController::class, 'arrivalEdit'])->name('arrival.edit');
    Route::patch('{type}/arrival-track/{track}',[TrackController::class, 'arrivalUpdate'])->name('arrival.update');

    // Logout
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});
