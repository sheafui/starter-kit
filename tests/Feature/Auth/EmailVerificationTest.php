<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('email verification screen can be rendered', function () {
    $user = User::factory()->unverified()->create();
    actingAs($user);
    get(route('verification.notice'))->assertOk();
});
it('can verify email', function () {

    $user = User::factory()
        ->unverified()
        ->create();
    Event::fake();

    $verificationUrl = URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), [
        'id' => $user->id,
        'hash' => sha1($user->email),
    ]);
    actingAs($user);
    $response = get($verificationUrl)
        ->assertFound();
    Event::assertDispatched(Verified::class);
    expect($user->fresh()->hasVerifiedEmail())->toBeTrue();
    $response->assertRedirect(route('home', absolute: false));

});
it('can\'t verify email with invalid hash', function () {
    $user = User::factory()->unverified()->create();

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        [
            'id' => $user->id,
            'hash' => sha1('email-does-not-belongs-to-the-authenticated-user')]
    );
    actingAs($user)
        ->get($verificationUrl)
        ->assertForbidden();
    expect($user->fresh()->hasVerifiedEmail())->toBeFalse();
});
