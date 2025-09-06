<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Constants;
use App\Livewire\Forms\Auth\RegisterForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
final class Register extends Component
{
    public RegisterForm $form;

    public function register()
    {
        $this->form->register();

        $redirectUrl = Session::pull(Constants::AFTER_LOGIN_REDIRECT_URL) ?? route('guide.show', ['guide' => 'overview']);

        session()->flash('notify', [
            'content' => "Your account has been created successfully!",
            'type' => 'success'
        ]);
        
        $this->redirectIntended(default: $redirectUrl);

    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
