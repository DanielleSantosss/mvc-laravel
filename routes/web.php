<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/', [AppointmentController::class, 'index'])->name('appointments.index');

Route::resource('appointments', AppointmentController::class);

Route::get('pendents', [AppointmentController::class, 'pendents'])->name('appointments.pendents');

Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

require __DIR__.'/auth.php';
