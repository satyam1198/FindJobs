<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/dashboard', [JobPostController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/jobs/{id}', [JobPostController::class, 'show'])->middleware(['auth', 'verified'])->name('jobs.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/jobs-save', [JobPostController::class, 'store'])->name('jobs.store');
    Route::post('/apply-job', [ApplicationController::class, 'store'])->name('apply.job');
    Route::get('/my-applications', [ApplicationController::class, 'index'])->name('applications.index');
});

Route::middleware('role:admin')->group(function () {    
    Route::get('/create-job', function () {
        return Inertia::render('CreateJob');
    })->middleware(['auth', 'verified'])->name('create-job');

});

require __DIR__.'/auth.php';
