<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse; 


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return new JsonResponse([
        'data' => now(),
        'message' => "API running successfully.",
        'meta' => ['timestamp' => intdiv((int) now()->format('Uu'), 1000)],
    ], 200);
});

 