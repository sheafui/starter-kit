<?php

use App\Livewire\Settings\Account;
use App\Models\User;
use function Pest\Livewire\livewire;

test('profile page is displayed', function () {
    $this->actingAs(User::factory()->create());

    $this->get('/settings/account')->assertOk();
});

test('profile information can be updated', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = livewire(Account::class)
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->call('saveChanges');

    $response->assertHasNoErrors();

    $user->refresh();

    expect($user->name)->toEqual('Test User');
    expect($user->email)->toEqual('test@example.com');
    expect($user->email_verified_at)->toBeNull();
});

test('email verification status is unchanged when email address is unchanged', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = livewire(Account::class)
        ->set('name', 'Test User')
        ->set('email', $user->email)
        ->call('saveChanges');

    $response->assertHasNoErrors();

    expect($user->refresh()->email_verified_at)->not->toBeNull();
});

