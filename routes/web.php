<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard',[\App\Http\Controllers\Admin\DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['middleware' => ['role:'.App\Http\Controllers\Admin\RoleController::SUPPER_ADMIN]], function () {
        //user
        Route::resource('/users',App\Http\Controllers\Admin\UserController::class);

        Route::match(['GET','POST'],'/users/{id}/apply',[App\Http\Controllers\Admin\ApplyController::class,'applyUsers']);
        // permissions
        Route::resource('/permissions',App\Http\Controllers\Admin\PermissionController::class)->names('permissions');
        // permissions
        Route::resource('/roles',App\Http\Controllers\Admin\RoleController::class);
        Route::match(['GET','POST'],'/roles/{id}/apply',[App\Http\Controllers\Admin\ApplyController::class,'applyRoles']);
        // roadRoute
        Route::resource('/roadRoute',App\Http\Controllers\Admin\RoadRouteController::class);
    });

    Route::resource('/services',App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('/cars',App\Http\Controllers\Admin\CarController::class);
    Route::resource('/type_car',App\Http\Controllers\Admin\TypeCarController::class);
    Route::resource('/tickets',App\Http\Controllers\Admin\TicketController::class);
    Route::resource('/departure_times',App\Http\Controllers\Admin\DepartureTimeController::class);

});


Route::middleware('auth')->group(function () {
    Route::match(['POST'],'/search/permissions', [App\Http\Controllers\Api\PermissionController::class,'search']);
    Route::match(['POST'],'/search/roles', [App\Http\Controllers\Api\RoleController::class,'search']);
    Route::match(['POST'],'/search/users', [App\Http\Controllers\Api\UserController::class,'search']);
    Route::match(['POST'],'/search/services', [App\Http\Controllers\Api\ServiceController::class,'search']);
    Route::match(['POST'],'/search/type_car', [App\Http\Controllers\Api\TypeCarController::class,'search']);

    Route::match(['POST'],'/search/create', [App\Http\Controllers\Api\RoadRouteController::class,'getAddress']);
    Route::match(['POST'],'/search/edit', [App\Http\Controllers\Api\RoadRouteController::class,'getAddress']);
    Route::match(['POST'],'/search/roadRoute', [App\Http\Controllers\Api\RoadRouteController::class,'search']);
});

require __DIR__.'/auth.php';
