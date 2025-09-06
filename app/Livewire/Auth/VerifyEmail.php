<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

final class VerifyEmail extends Component
{
    public function sendVerification(): void
    {
        /** @var User $authUser */
        $authUser = Auth::user();

        if ($authUser->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('home', absolute: false), navigate: true);

            return;
        }

        $authUser->sendEmailVerificationNotification(); // i don't know vscode can't find the following method

        Session::flash('status', 'verification-link-sent');
    }

    public function render()
    {
        return view('livewire.auth.verify-email');
    }
}
