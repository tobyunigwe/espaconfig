<?php

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



Route::Resources([
    'configs' => ConfigController::class,
    'espas' => EspaController::class,
    'rules' => RuleController::class,
    'match' => MatchController::class,
]);

//Route::resource('espas.rules', 'EspaRuleController');

