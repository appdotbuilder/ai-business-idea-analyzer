<?php

use App\Http\Controllers\BusinessIdeaController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

// Business Idea Validator - Main functionality on home page
Route::controller(BusinessIdeaController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::post('/analyze', 'store')->name('business-ideas.store');
    Route::get('/idea/{businessIdea}', 'show')->name('business-ideas.show');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
