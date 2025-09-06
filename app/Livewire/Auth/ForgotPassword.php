<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ForgotPassword extends Component 
{
    public string $email;

    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status !== Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('notify', [
            'content' => "We have emailed your password reset link!",
            'type' => 'success'
        ]);
        session()->flash('status', __($status));
    }

    public function render()
    {
        /** @var View $view */
        $view = view('livewire.auth.forgot-password');

        return $view->layout('components.layouts.guest');
    }
}
