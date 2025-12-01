<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventController;

// Redirige la página de inicio a la pantalla de login
Route::get('/', function () {
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Dashboard que usa Jetstream DESPUÉS del login
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

    // Panel principal con sidebar
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Rutas de administración (roles, etc.)
    Route::prefix('admin')->name('admin.')->middleware(['role:admin|staff'])->group(function () {
        // Roles
        Route::resource('roles', RoleController::class);

        // Usuarios (incluye activar)
        Route::resource('users', UserController::class);
        Route::put('users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');

        // Eventos
        Route::resource('events', EventController::class);
    });
});
