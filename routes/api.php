<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\EspaController;
use App\Http\Controllers\ReceiverController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/actions', [ActionController::class, 'index']);
Route::get('/call', [ActionController::class, 'call']);

Route::get('/espa', [EspaController::class, 'index']);
Route::get('/espa/{id}', [EspaController::class, 'show']);

Route::get('/receiver', [ReceiverController::class, 'index']);
Route::get('/receiver/{id}', [ReceiverController::class, 'show']);
