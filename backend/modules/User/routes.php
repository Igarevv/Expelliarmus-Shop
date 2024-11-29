<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;
use Modules\User\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/current-user', [UserController::class, 'user'])->middleware('auth:sanctum');

    Route::put('/user/profile-information', [ProfileInformationController::class, 'update'])
        ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])
        ->name('user-profile-information.update');

    Route::put('/user/password', [PasswordController::class, 'update'])
        ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])
        ->name('user-password.update');
});
