<?php

use App\Http\Controllers\V1\Company\CompanyCreateController;
use App\Http\Controllers\V1\Company\CompanyDeleteController;
use App\Http\Controllers\V1\Company\CompanyIndexController;
use App\Http\Controllers\V1\Company\CompanyPaginateController;
use App\Http\Controllers\V1\Company\CompanyShowController;
use App\Http\Controllers\V1\Company\CompanyUpdateController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['jwt.verify'],
], function () {
    Route::post('/', CompanyCreateController::class)->name('create-company');
    Route::get('/', CompanyIndexController::class)->name('read-company.list');
    Route::get('/paginate', CompanyPaginateController::class)->name('read-company.paginate');
    Route::get('/{company}', CompanyShowController::class)->name('read-company.show');
    Route::patch('/{company}', CompanyUpdateController::class)->name('update-company');
    Route::delete('/{company}', CompanyDeleteController::class)->name('delete-company');
});
