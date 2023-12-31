<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::resource('/', function () {
//    return view(DashboardController::class,'index');
//});


Route::controller(AdminController::class)->group(function () {
    Route::get('/','dashboard')->middleware('auth');
    Route::get('/account','account')->middleware('admin');
    Route::get('/account/{id}/edit','edit')->middleware('admin');
    Route::put('/account/{id}','update')->middleware('admin');
    Route::get('/account/add', 'create')->middleware('admin');
    Route::post('/account', 'store')->middleware('admin');
    Route::get('/account/{id}', 'show')->middleware('admin');
    Route::get('/account/delete/{id}', 'delete')->middleware('admin');
});

Route::controller(PostController::class)->group(function () {
    Route::get('/posts','posts')->middleware('auth');
});

Route::resource('/category',CategoryController::class);

Route::controller(AuthController::class)->group(function () {
    Route::get('/login','index') ->name('login')->middleware('guest');
    Route::post('/login','authenticate') ->middleware('guest');
    Route::post('/logout','logout');
    Route::get('/register','create')->middleware('guest');
    Route::post('/register','store')->middleware('guest');

});
