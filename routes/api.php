<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\EspaController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\MatchController;
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


// list all Espa
Route::get('/espas', [EspaController::class, 'index']);

//list a single espa
Route::get('/espa/{id}', [EspaController::class, 'show']);

// create new espa
Route::post('/espas', [EspaController::class, 'store']);

// create new espa
Route::post('/espa{id}', [EspaController::class, 'store']);

// update espa
Route::put('/espa/{id}', [EspaController::class, 'update']);

// delete a espa
Route::delete('/espa/{id}', [EspaController::class, 'destroy']);


//list all rules
Route::get('/rules', [RuleController::class, 'index']);


//list a single rule
Route::get('/rule/{id}', [RuleController::class, 'show']);

// create new rules
Route::post('/rules', [RuleController::class, 'store']);

// update rule
Route::put('/rule/{id}', [RuleController::class, 'update']);

// delete a rule
Route::delete('/rule/{id}', [RuleController::class, 'destroy']);

//list all Matches
Route::get('/matches', [MatchController::class, 'index']);

//list a single Match
Route::get('/match/{id}', [MatchController::class, 'show']);

// create new Matches
Route::post('/matches', [MatchController::class, 'store']);

// update a Match
Route::put('/match/{id}', [MatchController::class, 'update']);

// delete a Match
Route::delete('/match/{id}', [MatchController::class, 'destroy']);


