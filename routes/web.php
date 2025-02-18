<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProspectController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::get('/salesai', function(){
    $response = Http::withToken(config('services.openai.secret'))
        ->post('https://api.openai.com/v1/chat/completions',
            [
                "model"=> "gpt-4o-mini",
                "messages"=> [
                    [
                        "role"=> "system",
                        "content"=> "You are a helpful assistant."
                    ],
                    [
                        "role"=> "user",
                        "content"=> "In 25 words or less. write a simple sales pitch."
                    ]
                ]
            ])->json('choices.0.message.content');

    return view('salesai', ['response' => $response]);
})->name('salesai');
require __DIR__.'/auth.php';
