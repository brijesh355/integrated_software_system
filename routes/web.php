<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserAuthControler;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {

    return view('welcome');
});

// User Route 
Route::group(['prefix' => 'user/'], function () {
    // Pre Login User Middleware
    Route::group(['middleware' => 'user.guest'], function () {
        // Pre Login User Route
        Route::controller(UserAuthControler::class)->group(function () {
            Route::get('login', 'login')->name('user.login');
            Route::post('authenticate', 'authenticate')->name('user.authenticate');
        });
    });

    // After Login User Middleware
    Route::group(['middleware' => 'user.auth'], function () {
        // After Login User Route
        Route::controller(UserAuthControler::class)->group(function () {
            Route::get('dashboard','dashboard')->name('user.dashboard');
            Route::get('logout','logout')->name('user.logout'); 
        });
    });
});
