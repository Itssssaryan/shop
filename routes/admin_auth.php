<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->name('admin.')->prefix('admin')->group(function () {
    Route::get('register', [RegisteredAdminController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredAdminController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);


});

Route::middleware('auth:admin')->name('admin.')->prefix('admin')->group(function () {

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

