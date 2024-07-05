<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('pendents', [AppointmentController::class, 'pendents'])->name('appointments.pendents');
Route::resource('appointments', AppointmentController::class);

require __DIR__.'/auth.php';
