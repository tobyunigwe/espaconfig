<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\SshController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ConfigurationsController;


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



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/configurations', [App\Http\Controllers\ConfigurationController::class, 'index'])->name('configurations');


//Ssh Routes
Route::get('/ssh2', [SshController::class, 'connect'])->name('ssh2');
Route::get('/deployment', [SshController::class, 'index'])->name('deployment');


