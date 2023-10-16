<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserAuthControler;
use App\Http\Controllers\User\TaskManagementController;

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
            Route::get('register', 'register')->name('user.register');
            Route::post('register-store', 'registerStore')->name('user.registerStore');
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
            Route::get('edit-profile','editProfile')->name('user.edit.profile');
            Route::post('update-profile','updateProfile')->name('user.update.profile');
        });
        // Google Login 
        Route::get('auth/google', [GoogleController::class, 'signInwithGoogle']);
        Route::get('callback/google', [GoogleController::class, 'callbackToGoogle']);

        // Task Management Route
        Route::controller(TaskManagementController::class)->group(function () {
            Route::get('task','taskList')->name('user.taskList');
            Route::get('create-task','createTask')->name('user.create.task');
            Route::post('store-task','storeTask')->name('user.store.task');
            Route::get('edit-task/{id}','editTask')->name('user.edit.task');
            Route::post('update-task/{id}','updateTask')->name('user.update.task');
            Route::get('delete-task/{id}','deleteTask')->name('user.delete.task');
            Route::get('status-task-filter','filterTask')->name('user.filter.task');
        });
    });
});
