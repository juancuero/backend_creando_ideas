<?php

use App\Http\Controllers\V1\User\UserCreateController;
use App\Http\Controllers\V1\User\UserDeleteController;
use App\Http\Controllers\V1\User\UserIndexController;
use App\Http\Controllers\V1\User\UserPaginateController;
use App\Http\Controllers\V1\User\UserShowController;
use App\Http\Controllers\V1\User\UserUpdateController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['jwt.verify', 'permission'],
], function () {
    Route::post('/', UserCreateController::class)->name('create-user');
    Route::get('/', UserIndexController::class)->name('read-user.list');
    Route::get('/paginate', UserPaginateController::class)->name('read-user.paginate');
    Route::get('/{user}', UserShowController::class)->name('read-user.show');
    Route::patch('/{user}', UserUpdateController::class)->name('update-user');
    Route::delete('/{user}', UserDeleteController::class)->name('delete-user');
});
