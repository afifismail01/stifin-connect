<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdmin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard berdasarkan role
    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])->name('dashboard');

    // Profile
    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');

});

Route::middleware([
    'auth',
    'super-admin'
])->group(function () {

    Route::get(
        '/super-admin/users',
        [UserController::class, 'index']
    )->name('super-admin.users');

    Route::patch(
        '/super-admin/users/{user}/role',
        [UserController::class, 'updateRole']
    )->name('super-admin.users.role');

});

require __DIR__.'/auth.php';