<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Employer\DashboardController;
use App\Http\Controllers\Employer\JobListingController;
use App\Http\Controllers\Employer\EmployerProfileController;
use App\Http\Controllers\Employer\ApplicationController;
use App\Models\JobListing;
use App\Http\Controllers\Jobseeker\DashboardController as JobseekerDashboardController;
use App\Http\Controllers\Jobseeker\JobListingController as JobseekerJobListingController;
use App\Http\Controllers\Jobseeker\JobseekerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $jobs = JobListing::where('status', 'open')->latest()->get();
    return view('home', compact('jobs'));
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'employer') {
        return redirect('/employer/dashboard');
    } elseif (auth()->user()->role === 'jobseeker') {
        return redirect('/jobseeker/dashboard');
    } else {
        return view('dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'jobseeker'])->group(function () {
    Route::get('/jobseeker/dashboard', [JobseekerDashboardController::class, 'index'])->name('jobseeker.dashboard');
    Route::get('/jobseeker/profile/edit', [JobseekerController::class, 'edit'])->name('jobseeker.profile.edit');
    Route::patch('/jobseeker/profile', [JobseekerController::class, 'update'])->name('jobseeker.profile.update');
    Route::get('/job-listings/browse', [JobseekerJobListingController::class, 'browse'])->name('job-listings.browse');
    Route::get('/jobs/{jobListing}', [JobseekerJobListingController::class, 'show'])->name('jobs.show');
    Route::post('/jobs/{jobListing}/apply', [JobseekerController::class, 'apply'])->name('job-listings.apply');
    Route::get('/jobseeker/applications', [JobseekerController::class, 'applications'])->name('jobseeker.applications');
    Route::get('/jobseeker/cv/{application}', [JobseekerController::class, 'viewCV'])->name('jobseeker.cv.view');
});

Route::middleware(['auth', 'employer'])->group(function () {
    Route::get('/employer/dashboard', [DashboardController::class, 'index'])->name('employer.dashboard');
    Route::get('/employer/profile/edit', [EmployerProfileController::class, 'edit'])->name('employer.profile.edit');
    Route::patch('/employer/profile', [EmployerProfileController::class, 'update'])->name('employer.profile.update');
    Route::resource('job-listings', JobListingController::class);
    Route::get('job-listings/{jobListing}/applications', [ApplicationController::class, 'index'])->name('job-listings.applications');
    Route::get('job-listings/{jobListing}/applications/{application}/cv', [ApplicationController::class, 'viewCV'])->name('employer.cv.view');
});

require __DIR__ . '/auth.php';
