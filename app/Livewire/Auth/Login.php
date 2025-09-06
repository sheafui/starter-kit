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

        
        session()->flash('notify', [
            'content' => "You have successfully logged in!",
            'type' => 'success'
        ]);

        $this->redirectIntended(default: '/');
    }

    public function render()
    {
                /** @var View $view */
        $view = view('livewire.auth.login');

        return $view->layout('components.layouts.app');
    }
}
