<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Livewire\Auth\ConfirmPassword;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

test('confirm password screen can be rendered', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get('/confirm-password')
        ->assertOk();
});

test('password can be confirmed', function () {
    $user = User::factory()->create();

    actingAs($user);

    livewire(ConfirmPassword::class)
        ->set('password', 'password')
        ->call('confirmPassword')
        ->assertRedirect(route('dashboard'))
        ->assertHasNoErrors();
});

test('password is not confirmed with invalid password', function () {
    $user = User::factory()->create();

    actingAs($user);

    livewire(ConfirmPassword::class)
        ->set('password', 'wrong-password')
        ->call('confirmPassword')
        ->assertNoRedirect()
        ->assertHasErrors();
});
