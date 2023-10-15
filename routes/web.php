<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserAuthControler;

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
Route::group(['prefix' => 'user/'], function(){

    Route::controller(UserAuthControler::class)->group(function(){
        Route::get('register','signup')->name('admin.login');
        Route::post('authenticate','authenticate')->name('admin.authenticate');
    });
});