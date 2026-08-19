<?php

use App\Actions\Auth\Logout;
use App\Livewire;
use App\Livewire\Auth\ConfirmPassword;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\VerifyEmail;
use App\Livewire\Dashboard;
use App\Livewire\Settings\Account;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::livewire('/', Livewire\Home::class)->name('home');

/** AUTH ROUTES */
Route::livewire('/register', Register::class)->name('register');

Route::livewire('/login', Login::class)->name('login');

Route::livewire('/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::livewire('reset-password/{token}', ResetPassword::class)->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::livewire('/dashboard', Dashboard::class)->name('dashboard');
    Route::livewire('/settings/account', Account::class)->name('settings.account');
});

Route::middleware(['auth'])->group(function () {
    Route::livewire('/auth/verify-email', VerifyEmail::class)
        ->name('verification.notice');
    Route::post('/logout', Logout::class)
        ->name('app.auth.logout');
    Route::livewire('confirm-password', ConfirmPassword::class)
        ->name('password.confirm');
});

Route::middleware(['auth', 'signed'])->group(function () {
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect(route('home'));
    })->name('verification.verify');
});
