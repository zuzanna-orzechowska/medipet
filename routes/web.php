<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//trasa klienta
Route::middleware(['auth', 'role:klient'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('pets', PetController::class);
    Route::resource('appointments', AppointmentController::class);
});

// trasa lekarza
Route::middleware(['auth', 'role:lekarz'])->group(function () {
    Route::get('/doctor/dashboard', [AppointmentController::class, 'doctorIndex'])->name('doctor.dashboard');
    
    Route::patch('/appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('doctor.appointments.status');
});

//trasa admina
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Route::resource('services', ServiceController::class);
    // Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
});


require __DIR__.'/auth.php';