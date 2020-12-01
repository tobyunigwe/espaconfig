<?php

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

////Standard routes
//Route::get('/', function () {
//    return view('home');
//});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/configurations', [App\Http\Controllers\ConfigurationController::class, 'xml'])->name('configurations');

//Admin Routes
Route::prefix('admin')->middleware('can:manage-users')->name('admin.')->group(function () {
    Route::resources([
        '/users' => UsersController::class
    ]);
});

//Ssh Routes
Route::get('/sshs', [SshController::class, 'connect'])->name('ssh');
Route::get('/deployment', [SshController::class, 'index'])->name('deployment');


