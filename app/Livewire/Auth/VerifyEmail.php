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

        $authUser->sendEmailVerificationNotification(); 

        Session::flash('status', 'verification-link-sent');
    }

    public function render()
    {
        /** @var View $view */
        $view = view('livewire.auth.verify-email');

        return $view->layout('components.layouts.guest');
    }
}
