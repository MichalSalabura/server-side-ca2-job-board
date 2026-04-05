<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Employer\DashboardController;
use App\Http\Controllers\Employer\JobListingController;
use App\Http\Controllers\Employer\EmployerProfileController;
use App\Http\Controllers\Employer\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'employer'])->group(function () {
    Route::get('/employer/dashboard', [DashboardController::class, 'index'])->name('employer.dashboard');
    Route::get('/employer/profile/edit', [EmployerProfileController::class, 'edit'])->name('employer.profile.edit');
    Route::patch('/employer/profile', [EmployerProfileController::class, 'update'])->name('employer.profile.update');
    Route::resource('job-listings', JobListingController::class);
    Route::get('job-listings/{jobListing}/applications', [ApplicationController::class, 'index'])->name('job-listings.applications');
});

require __DIR__ . '/auth.php';
