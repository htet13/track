<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Hr\AdvanceEmployeeController;
use App\Http\Controllers\Backend\Hr\BonusController;
use App\Http\Controllers\Backend\Hr\EmployeeController;
use App\Http\Controllers\Backend\Hr\DriveFeeController;
use App\Http\Controllers\Backend\Hr\ReportController;
use App\Http\Controllers\Backend\Hr\SalaryController;

Route::group(['prefix' => 'hr', 'as' => 'hr.', 'middleware' => 'auth'], function () {

    //Employee
    Route::resource('{status}/employee',EmployeeController::class);

    //Employee Resign 
    Route::get('resign/{employee}/{status}',[EmployeeController::class,'resign'])->name('employee.resign');
    Route::put('resign/{employee}/{status}/update',[EmployeeController::class,'resignUpdate'])->name('employee.resign.update');

    //Advance Employee 
    Route::resource('advance-employee',AdvanceEmployeeController::class);

    //Bonus
    Route::resource('bonuses',BonusController::class);

    //Salary
    Route::resource('employee/salary',SalaryController::class)->except(['create','store']);
    Route::get('sync-employee',[SalaryController::class, 'syncEmployee'])->name('sync_employee');

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

    //Report
    Route::get('report/advance-employee',[ReportController::class, 'advanceEmployee'])->name('report.advanceEmployee');
});

