<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Appointments (Accessible by authenticated users, controlled in views/controller)
    Route::get('/appointments/export/{format}', [\App\Http\Controllers\AppointmentController::class, 'export'])->name('appointments.export');
    Route::resource('appointments', \App\Http\Controllers\AppointmentController::class);
    
    // Payments (Accessible by authenticated users, controlled in views/controller)
    Route::get('/payments/export/{format}', [\App\Http\Controllers\PaymentController::class, 'export'])->name('payments.export');
    Route::resource('payments', \App\Http\Controllers\PaymentController::class);
    
    // AJAX Endpoint for Appointment Slots
    Route::get('/api/available-slots', [\App\Http\Controllers\AppointmentController::class, 'getAvailableSlots'])->name('api.available-slots');
});

// Role-based routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin routes (Manage users, departments, etc.)
    Route::resource('departments', \App\Http\Controllers\DepartmentController::class);
    Route::resource('doctors', \App\Http\Controllers\DoctorController::class);
});

Route::middleware(['auth', 'role:receptionist,admin'])->group(function () {
    // Receptionist routes (Manage appointments, patients)
    Route::resource('patients', \App\Http\Controllers\PatientController::class);
});

Route::middleware(['auth', 'role:doctor'])->group(function () {
    // Doctor routes (View schedules, patients)
});

Route::middleware(['auth', 'role:cashier,admin'])->group(function () {
    // Cashier routes (Manage payments)
});

Route::middleware(['auth', 'role:patient'])->group(function () {
    // Patient routes (View appointments, history)
});

require __DIR__.'/auth.php';
