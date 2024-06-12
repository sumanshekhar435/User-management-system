<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserProfileController;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('registration', [AuthController::class, 'registration'])->name('register');
    Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('user-profile-edit', [UserProfileController::class, 'edit'])->name('user-profile');
    Route::post('post-user-profile-edit', [UserProfileController::class, 'postEdit'])->name('post-user-profile-edit');
    Route::post('upload-user-profile-image', [UserProfileController::class, 'uploadProfileImage'])->name('upload-user-profile-image');
    Route::post('remove-user-profile-image', [UserProfileController::class, 'removeProfileImage'])->name('remove-user-profile-image');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
