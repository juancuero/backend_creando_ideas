<?php

use App\Http\Controllers\V1\Employee\EmployeeCreateController;
use App\Http\Controllers\V1\Employee\EmployeeDeleteController;
use App\Http\Controllers\V1\Employee\EmployeeIndexController;
use App\Http\Controllers\V1\Employee\EmployeePaginateController;
use App\Http\Controllers\V1\Employee\EmployeeShowController;
use App\Http\Controllers\V1\Employee\EmployeeUpdateController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['jwt.verify'],
], function () {
    Route::post('/', EmployeeCreateController::class)->name('create-employee');
    Route::get('/', EmployeeIndexController::class)->name('read-employee.list');
    Route::get('/paginate', EmployeePaginateController::class)->name('read-employee.paginate');
    Route::get('/{employee}', EmployeeShowController::class)->name('read-employee.show');
    Route::patch('/{employee}', EmployeeUpdateController::class)->name('update-employee');
    Route::delete('/{employee}', EmployeeDeleteController::class)->name('delete-employee');
});
