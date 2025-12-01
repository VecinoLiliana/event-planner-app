<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;

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
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('roles', RoleController::class);
    });
});
