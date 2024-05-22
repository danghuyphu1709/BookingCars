<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// services
Route::match(['POST'],'/services',[App\Http\Controllers\Api\ServiceController::class,'store']);

Route::match(['GET','POST'],'/services/{id}',[App\Http\Controllers\Api\ServiceController::class,'update']);


// services
Route::match(['POST'],'/type_car',[App\Http\Controllers\Api\TypeCarController::class,'store']);

Route::match(['GET','POST'],'/type_car/{id}',[App\Http\Controllers\Api\TypeCarController::class,'update']);

// client
Route::match(['POST','GET'],'/home',[App\Http\Controllers\Api\HomeController::class,'index']);


