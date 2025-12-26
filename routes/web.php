<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/appointments', [AdminController::class, 'appointments'])->name('admin.appointments');
    Route::delete('/appointments/{appointment}', [AdminController::class, 'destroyAppointment'])->name('admin.appointments.destroy');
    Route::patch('/appointments/{appointment}/status', [AdminController::class, 'updateAppointmentStatus'])->name('admin.appointments.updateStatus');

    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');

    Route::get('/pets', [AdminController::class, 'pets'])->name('admin.pets');
    Route::get('/pets/{pet}/edit', [AdminController::class, 'editPet'])->name('admin.pets.edit');
    Route::put('/pets/{pet}', [AdminController::class, 'updatePet'])->name('admin.pets.update');
    Route::delete('/pets/{pet}', [AdminController::class, 'destroyPet'])->name('admin.pets.destroy');
});


require __DIR__.'/auth.php';