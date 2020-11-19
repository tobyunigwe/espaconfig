<?php

use App\Http\Controllers\SshController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EspaSdrXmlController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\Admin\UsersController;

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

//Standard routes
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Editor routes
Route::middleware('can:access-editor')->group(function () {
    Route::get('/editor', [DataController::class, 'index'])->name('editor');
    Route::get('/editor/add', [DataController::class, 'create'])->name('add');
    Route::post('/editor/store', [DataController::class, 'store'])->name('store');
    Route::get('/editor/delete/{id}', [DataController::class, 'destroy'])->name('destroy');
    Route::get('/editor/edit/{id}', [DataController::class, 'edit'])->name('edit');
    Route::put('/editor/update/{id}', [DataController::class, 'update'])->name('update');
});

//Admin Routes
Route::prefix('admin')->middleware('can:manage-users')->name('admin.')->group(function () {
    Route::resources([
        '/users' => UsersController::class
    ]);
});

//Ssh Routes
Route::get('/sshs', [SshController::class, 'connect']);
//Route::resource('data',DataController::class);
