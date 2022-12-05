<?php

use App\Http\Controllers\Api\AuthApiControllers;
use App\Http\Controllers\Api\ProblemController;
use App\Http\Controllers\Api\RepairController;
use App\Http\Controllers\API\RepairProblem;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RepairProblemController;
use App\Http\Controllers\UserModelController;
// use App\Http\Controllers\API\RepairProblem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthApiControllers::class, 'register']);
    Route::post('login', [AuthApiControllers::class, 'login']);
    Route::post('forget-password', [AuthApiControllers::class, 'forgetPassword']);
    Route::post('reset-password', [AuthApiControllers::class, 'resetPassword']);

});

Route::prefix('auth')->middleware('auth:user-api')->group(function () {
    Route::post('change-password', [AuthApiControllers::class, 'changePassword']);
    Route::get('logout', [AuthApiControllers::class, 'logout']);
    // Route::apiResource('repairproblem',[RepairProblemController::class]);

    Route::get('repairproblem/index',[RepairProblemController::class ,'index']);
    Route::post('repairproblem/store',[RepairProblemController::class ,'store']);
    Route::get('repairproblem/{id}',[RepairProblem::class ,'show']);
    Route::get('repairs/index', [RepairController::class, 'index']);
    Route::post('repairs/store', [RepairController::class,'store']);



    

});

Route::middleware('auth:user-api')->group(function () {
    Route::get('user-model', [UserModelController::class,'indexUserModels']);
    Route::get('UserModel/category/{id}/brand/{branId}', [CategoryController::class, 'getModel']);
    Route::post('UserModel/store', [UserModelController::class, 'updateUserModels']);
    Route::apiresource('problems',ProblemController::class);

});
