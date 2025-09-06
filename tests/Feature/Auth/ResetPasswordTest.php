<?php

declare(strict_types=1);

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword as AuthResetPassword;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

test('reset password can be rendered', function () {
    get(route('forgot-password'))->assertOk();
});
test('reset password can be requested', function () {
    Notification::fake();

    $user = User::factory()->create();
    livewire(ForgotPassword::class)
        ->set('email', $user->email)
        ->call('sendPasswordResetLink');

    Notification::assertSentTo($user, ResetPassword::class);
});
test('reset password screencan be rendered', function () {
    Notification::fake();
    $user = User::factory()->create();
    livewire(ForgotPassword::class)
        ->set('email', $user->email)
        ->call('sendPasswordResetLink');

    Notification::assertSentTo(
        notifiable: $user,
        notification: ResetPassword::class,
        callback: function (ResetPassword $notification) {
            get('/reset-password/'.$notification->token)
                ->assertSee('Reset your password') // just for making sure that we're in the reset password page
                ->assertOk();

            return true;
        }
    );
});

test('password can be reset with valid token', function () {
    Notification::fake();
    $user = User::factory()->create();
    livewire(ForgotPassword::class)
        ->set('email', $user->email)
        ->call('sendPasswordResetLink');

    Notification::assertNotSentTo(
        notifiable: $user,
        notification: ResetPassword::class,
        callback: function (ResetPassword $notification) use ($user) {
            livewire(AuthResetPassword::class, ['token' => $notification->token])
                ->set('email', $user->email)
                ->set('password', 'password')
                ->set('password_confirmation', 'password')
                ->call('resetPassword')
                ->assertRedirect(route('login'))
                ->assertHasNoErrors();
        }
    );
});
test('password can\'t be reset with invalid token', function () {
    Notification::fake();
    $user = User::factory()->create();
    livewire(ForgotPassword::class)
        ->set('email', $user->email)
        ->call('sendPasswordResetLink');

    Notification::assertNotSentTo(
        notifiable: $user,
        notification: ResetPassword::class,
        callback: function (ResetPassword $notification) use ($user) {
            livewire(AuthResetPassword::class, ['token' => Str::random()])
                ->set('email', $user->email)
                ->set('password', 'password')
                ->set('password_confirmation', 'password')
                ->call('resetPassword')
                ->assertHasErrors();
        }
    );
});
