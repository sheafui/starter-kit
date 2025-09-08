<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Livewire\Concerns\HasToast;
use App\Support\Toast;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ForgotPassword extends Component
{
    use HasToast;
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

        $this->toastSuccess('We have emailed your password reset link!');

        session()->flash('status', __($status));
    }

    public function render()
    {
        /** @var View $view */
        $view = view('livewire.auth.forgot-password');

        return $view->layout('components.layouts.guest');
    }
}
