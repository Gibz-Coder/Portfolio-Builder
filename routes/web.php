<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PortfolioProfileController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Public portfolio routes
Route::get('/portfolio/{user}', [LandingController::class, 'portfolio'])->name('portfolio.show');
Route::post('/contact/{user}', [MessageController::class, 'store'])->name('contact.store');

// Registration pending page
Route::get('/registration-pending', function () {
    return view('auth.registration-pending');
})->name('registration.pending');

// Dashboard - requires authentication and admin approval (not email verification)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'approved'])->name('dashboard');

// Authenticated user routes - requires admin approval (not email verification)
Route::middleware(['auth', 'approved'])->group(function () {
    // Breeze profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Portfolio management routes
    Route::resource('portfolio-profile', PortfolioProfileController::class)->except(['show']);
    Route::resource('skills', SkillController::class);
    Route::resource('education', EducationController::class);
    Route::resource('experiences', ExperienceController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('messages', MessageController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::resource('socials', SocialController::class);
    
    // Message actions
    Route::patch('/messages/{message}/mark-read', [MessageController::class, 'markAsRead'])->name('messages.mark-read');
});

// Admin routes - requires authentication and admin approval (not email verification) and admin role
Route::middleware(['auth', 'approved', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::patch('/users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');
    Route::patch('/users/{user}/unapprove', [UserController::class, 'unapprove'])->name('users.unapprove');
});

require __DIR__.'/auth.php';
