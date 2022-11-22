<?php

use App\Http\Controllers\AdminProfileConroller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\PermissionController;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProductModelController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\SparePartProductModelController;
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
        Route::middleware('guest:admin,user')->group(function () {
            Route::get('{guard}/forgot-password', [ResetPasswordController::class, 'showForgotPassword'])->name('password.request');
            Route::post('forgot-password', [ResetPasswordController::class, 'emailForgetPassword'])->name('password.email');
            Route::get('{guard}/reset-password/{token}', [ResetPasswordController::class, 'showResetPassword'])->name('password.reset');
            Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
        });

        Route::prefix('cms')->middleware('guest:admin,user')->group(function () {
            Route::get('login/{guard}', [AuthController::class, 'showLogin'])->name('cms.login');
            Route::post('/login', [AuthController::class, 'login']);
        });

        Route::prefix('cms')->middleware('auth:admin')->group(function () {

            Route::resource('/admins', AdminController::class);
            Route::resource('/categories', CategoryController::class);
            Route::resource('/subcategories', SubCategoryController::class);
            Route::resource('/users', UserController::class);
            Route::resource('/productmodels', ProductModelController::class);
            Route::resource('/spareparts', SparePartController::class);



            Route::resource('roles', RoleController::class);
            Route::get('/admin/editPassword', [AuthController::class, 'editPassword'])->name('admin.editPassword');
            Route::post('/admin/updatePassword', [AuthController::class, 'updatePassword'])->name('admin.updatePassword');
            Route::resource('permissions/role', RolePermissionController::class);
            Route::resource('permissions', PermissionController::class);
            Route::resource('languages', LanguageController::class);

            Route::get('/sparepartss/{spareparts}/models/edit', [SparePartController::class, 'editSparepartModels'])->name('spareparts.edit-models');
            Route::put('/spaerparts/product_models/edit', [SparePartController::class, 'updateSparepartModels']);




            Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');


            Route::post('user/change-status/{id}', [UserController::class, 'UserActive'])->name('users.UserActive');
        });
        Route::prefix('cms')->middleware('auth:admin,user')->group(function () {
            Route::get('/profileEdit', [AdminProfileConroller::class, 'EditProfile'])->name('profile.edit');
            Route::put('/profile/Update', [AdminProfileConroller::class, 'profileUpdate'])->name('profile.update');
            Route::get('/editPassword', [AuthController::class, 'editPassword'])->name('auth.editPassword');
            Route::post('/updatePassword', [AuthController::class, 'updatePassword'])->name('auth.updatePassword');
            Route::get('/dashboard', [AuthController::class, 'indexAuth'])->name('auth.dashboard');
            Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

        });
    }


);