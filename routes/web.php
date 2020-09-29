<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('espasdr',EspaSdrXmlController::class);

//Route::resource('data',DataController::class);

Route::get('/', [DataController::class,'index'])->name('editor');
//    ->middleware('can:access-editor');

Route::get('/add', [DataController::class,'create']);
Route::post('/store', [DataController::class,'store']);
Route::get('/delete/{id}', [DataController::class,'destroy']);
Route::get('/edit/{id}', [DataController::class,'edit']);
Route::put('/update/{id}', [DataController::class,'update']);

Route::get('/add2', [DataController::class,'createadd2']);
Route::post('/store2', [DataController::class,'store2']);


//Route::get('/espasdr', 'EspaSdrXmlController@create')->name('create');
Route::prefix('admin')->middleware('can:manage-users')->name('admin.')->group(function () {
    Route::resources([
        '/users' => UsersController::class
    ]);
});

