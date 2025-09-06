<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Constants;
use App\Livewire\Forms\Auth\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
final class Login extends Component
{
    public LoginForm $form;

    public function login()
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $redirectUrl = Session::pull(Constants::AFTER_LOGIN_REDIRECT_URL) ?? route('guide.show', ['guide' => 'overview']);
        
        session()->flash('notify', [
            'content' => "You have successfully logged in!",
            'type' => 'success'
        ]);

        $this->redirectIntended(default: $redirectUrl);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
