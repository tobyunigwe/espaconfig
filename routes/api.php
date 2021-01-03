<?php

use App\Http\Controllers\ApiController;


use Illuminate\Http\Request;
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


Route::resource('/configurations', ApiController::class);
Route::post('/espasdrconfiguration', [ App\Http\Controllers\ApiController::class, 'handleIncomingRequest']);
Route::post('/status', [ App\Http\Controllers\ApiController::class, 'status']);

