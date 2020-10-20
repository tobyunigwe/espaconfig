<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\EspaController;
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


//list all configs
Route::get('/configs', [ConfigController::class, 'index']);

//list a single config
Route::get('/config/{id}', [ConfigController::class, 'show']);

// create new config
Route::post('/configs', [ConfigController::class, 'store']);

// update config
Route::put('/config/{id}', [ConfigController::class, 'update']);

// delete a config
Route::delete('/config/{id}', [ConfigController::class, 'destroy']);


//Espa route
Route::get('/espas', [EspaController::class, 'index']);


