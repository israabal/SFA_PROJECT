<?php

use App\Http\Controllers\AdminProfileConroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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







Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () { //...
        Route::prefix('cms')->middleware('guest:admin')->group(function () {
            Route::get('login/{guard}', [AuthController::class, 'showLogin'])->name('cms.login');
            Route::post('/login', [AuthController::class, 'login']);
        });
        Route::get('home', function () {
            return view('cms.parent');
        });

        Route::middleware('auth:admin')->group(function () {


            Route::get('/admin/editPassword', [AuthController::class, 'editPassword'])->name('admin.editPassword');
            Route::post('/admin/updatePassword', [AuthController::class, 'updatePassword'])->name('admin.updatePassword');

            Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
        });  // end Middleware admin

        Route::middleware('guest')->group(function () {
            Route::get('/forgot-password', [ResetPasswordController::class, 'requestPasswordReset'])->name('password.request');
            Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetEmail'])->name('password.email');
            Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
            Route::post('/reset-password', [ResetPasswordController::class, 'updatePassword'])->name('password.update');
        });

        Route::resource('users', UserController::class);
        Route::post('user/change-status/{id}', [UserController::class, 'UserActive'])->name('users.UserActive');
    }

);
