<?php

declare(strict_types=1);

use App\Livewire\Auth\Register;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

test('register screen can be rendered', function () {
    get(route('register'))->assertOk();
});

test('register screen has form', function () {
    livewire(Register::class)->assertSee('form');
});

test('new users can register using the register screen', function () {

    livewire(Register::class)
        ->set('form.name', 'Test User')
        ->set('form.email', 'test@example.com')
        ->set('form.password', 'password')
        ->set('form.password_confirmation', 'password')
        ->call('register')
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', false));

    $this->assertAuthenticated();
});

// validation

it('require all field in filling the registration form phase', function () {
    livewire(Register::class)
        ->call('register')
        ->assertHasErrors()
        ->assertNoRedirect();
    $this->assertGuest();
});
it('ensures that email must be a valid email address', function () {
    livewire(Register::class)
        ->set('form.name', 'Test User')
        ->set('form.email', 'invalid-email')
        ->set('form.password', 'password')
        ->set('form.password_confirmation', 'password')
        ->call('register')
        ->assertHasErrors(['form.email'])
        ->assertNoRedirect();

    $this->assertGuest();
});

test('new users can\'t register without a valid name', function () {
    livewire(Register::class)
        ->set('form.email', 'admin@gmail.com')
        ->set('form.password', 'password')
        ->set('form.password_confirmation', 'password')
        ->call('register')
        ->assertHasErrors(['form.name'])
        ->assertNoRedirect();

    $this->assertGuest();
});
test('new users can\'t register without a valid confirmation of the password', function () {
    livewire(Register::class)
        ->set('form.name', 'med')
        ->set('form.email', 'admin@gmail.com')
        ->set('form.password', 'password')
        ->set('form.password_confirmation', 'different_password')
        ->call('register')
        ->assertHasErrors(['form.password'])
        ->assertNoRedirect();

    $this->assertGuest();
});
test(' new users can\'t register with existing email address ', function () {
    $user = User::factory()->create([
        'email' => 'med@gmail.com',
    ]);
    livewire(Register::class)
        ->set('form.name', 'med')
        ->set('form.email', 'med@gmail.com')
        ->set('form.password', 'password')
        ->set('form.password_confirmation', 'password')
        ->call('register')
        ->call('register')
        ->assertHasErrors()
        ->assertSee('The email has already been taken.')
        ->assertNoRedirect();
    Mail::fake();
    Mail::assertNothingSent();
    $this->assertGuest();
});
