<?php

use App\Livewire\Settings\Account;
use App\Models\User;
use function Pest\Livewire\livewire;

it('can shows account page ', function () {
    $this->actingAs(User::factory()->create());

    $this->get('/settings/account')->assertOk();
});

it('can update email and name', function () {
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
    // now the email changed we need to make sure it trigger unverified status 
    expect($user->email_verified_at)->toBeNull();
});

it('keeps email verification status untouched when email address unchanges', function () {
    $user = User::factory()->create();

    $this->actingAs($user);


    $response = livewire(Account::class)
        ->set('name', 'Test User')
        ->set('email', $user->email)
        ->call('saveChanges');

    $response->assertHasNoErrors();

    expect($user->refresh()->email_verified_at)->not->toBeNull();
});

