<?php

declare(strict_types=1);

use App\Livewire\Auth\Login;
use App\Models\User;

use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

test('login screen can be rendered', function () {
    get(route('login'))->assertOk();
});

test('login screen has form', function () {
    livewire(Login::class)->assertSee('form');
});

test('users can authenticate using login screen', function () {
    $user = User::factory()->create();
    livewire(Login::class)
        ->set('form.email', $user->email)
        ->set('form.password', 'password')
        ->call('login')
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});
test('users can not authenticate using invalid password', function () {
    $user = User::factory()->create();
    livewire(Login::class)
        ->set('form.email', $user->email)
        ->set('form.password', 'wrong-password')
        ->call('login')
        ->assertHasErrors()
        ->assertNoRedirect(route('dashboard', absolute: false));

    $this->assertGuest();
});

test('users can logout from authentication', function () {

    /** @var Illuminate\Contracts\Auth\Authenticatable */
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->withSession(['_token' => 'test_token'])
        ->post(route('app.auth.logout'), ['_token' => 'test_token']);

    $response->assertRedirect('/');
    $this->assertGuest();
});
