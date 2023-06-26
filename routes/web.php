<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageAdminController;
use App\Http\Controllers\PageLoginController;
use App\Http\Controllers\PageRegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', function () {
    return view('orders.index');
});

Route::resource('orders', OrderController::class);


Route::get('/register', PageRegisterController::class)->name('register');
Route::post('/register', [UserController::class, 'register']);



Route::get('/login', PageLoginController::class)->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth', 'middleware' => 'admin:admin'], function () {
    // Здесь продолжайте свое творение
    Route::get('dashboard', function() { echo "HELLO WORLD"; } );
});
