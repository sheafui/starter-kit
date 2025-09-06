<?php

use App\Livewire;
use Illuminate\Support\Facades\Route;

Route::get('/', Livewire\Home::class)->name('home');

/** AUTH ROUTES */
// Route::get('/register', Register::class)->name('register');

// Route::get('/login', Login::class)->name('login');

// Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');

// Route::get('reset-password/{token}', ResetPassword::class)->name('password.reset');

// Route::get('/pricing', [PlansController::class, 'index'])->name('app.pricing');


// Route::middleware(['auth'])->group(function () {
//     Route::get('/auth/verify-email', VerifyEmail::class)
//         ->name('verification.notice');
//     Route::post('/logout', Logout::class)
//         ->name('app.auth.logout');
//     Route::get('confirm-password', ConfirmPassword::class)
//         ->name('password.confirm');
// });

// Route::middleware(['auth', 'signed'])->group(function () {
//     Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//         $request->fulfill();

//         return redirect(route('home'));
//     })->name('verification.verify');
// });
