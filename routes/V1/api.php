<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('test-log', [TestController::class, 'logueado'])->name('logueado');
});

Route::get('test-no-log', [TestController::class, 'nologueado'])->name('nologueado');
