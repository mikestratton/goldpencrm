<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PitchController;
use App\Http\Controllers\SalesAiController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProspectController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('prospects', ProspectController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('notes', NoteController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::get('/salesai', function () {
    return view('salesai');
})->name('salesai')->middleware(['auth', 'verified']);

Route::post('/salesai/process', [SalesAiController::class, 'process'])->name('salesai.process');
Route::post('/salesai/save', [SalesAiController::class, 'save'])->name('salesai.save');

Route::delete('/salesai/{aiResponse}', [SalesAiController::class, 'destroy'])->name('salesai.destroy')
    ->middleware(['auth', 'verified']);

Route::resource('pitches', PitchController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::get('/salesai/{pitch}/edit', [SalesAiController::class, 'edit'])->name('salesai.edit');
Route::put('/salesai/{pitch}', [SalesAiController::class, 'update'])->name('salesai.update');

require __DIR__.'/auth.php';
