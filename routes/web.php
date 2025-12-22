<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPermissionController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', function () {
    return view('layouts.webpage');
})->name('home');

Route::get('/home', function () {
    return view('layouts.home');
});

Route::middleware('auth')->group(function () {

    Route::prefix('role')->group(function () {
        Route::get('', [RoleController::class, 'index'])->name('role.index');
        Route::group(['middleware' => 'permission:Role,create'], function () {
            Route::get('/create', [RoleController::class, 'create'])->name('role.create');
            Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        });
        Route::group(['middleware' => 'permission:Role,read'], function () {
            Route::get('/{id}', [RoleController::class, 'show'])->name('role.show');
        });
        Route::group(['middleware' => ['permission:Role,update']], function () {
            Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');
            Route::put('/{id}', [RoleController::class, 'update'])->name('role.update');
        });
        Route::group(['middleware' => 'permission:Role,delete'], function () {
            Route::get('delete/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
        });
    });

    Route::prefix('user')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('user.index');
        Route::group(['middleware' => 'permission:User,create'], function () {
            Route::get('/create', [UserController::class, 'create'])->name('user.create');
            Route::post('/store', [UserController::class, 'store'])->name('user.store');
        });
        Route::group(['middleware' => 'permission:User,read'], function () {
            Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
        });
        Route::group(['middleware' => 'permission:User,update'], function () {
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
        });
        Route::group(['middleware' => 'permission:User,delete'], function () {
            Route::get('delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        });
        // Route::post('reset-password', [UserController::class, 'resetPassword'])->name('user.reset-password');
        // Route::group(['middleware' => 'permission:User Reset Password,create'], function () {});
        // Route::group(['middleware' => 'permission:User Assign Event,create'], function () {});
        // Route::post('assignEvent', [UserController::class, 'assignEvent'])->name('user.assignEvent');
        // Route::post('assignDepartment', [UserController::class, 'assignDepartment'])->name('user.assignDepartment');

        // Route::get('status/{id}', [UserController::class, 'statusManage'])->name('user.status');
        // Route::get('getUserDetails/{id}', [UserController::class, 'getUserDetails'])->name('user.getUserDetails');
        // Route::get('/calendar/{id}', [UserController::class, 'calendar'])->name('user.calendar');
        // Route::get('/getEventUser/{id}', [UserController::class, 'getEventUser'])->name('user.getEventUser');
    });

});

require __DIR__ . '/auth.php';

// User permissions routes
Route::get('/user/{id}/permissions', [UserPermissionController::class, 'edit'])->name('user.permissions-edit');
Route::put('/user/{id}/permissions', [UserPermissionController::class, 'update'])->name('user.permissions-update');
