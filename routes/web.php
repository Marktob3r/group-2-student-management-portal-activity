<?php

use App\Http\Controllers\EnrolleeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [EnrolleeController::class, 'index'])->name('dashboard');
    Route::post('/enrollees', [EnrolleeController::class, 'store'])->name('enrollees.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';