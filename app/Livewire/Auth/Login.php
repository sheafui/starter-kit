<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Constants;
use App\Livewire\Concerns\HasToast;
use App\Livewire\Forms\Auth\LoginForm;
use App\Support\Toast;
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

        Toast::success("You have successfully logged in!"); 

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    public function render()
    {
        /** @var View $view */
        $view = view('livewire.auth.login');

        return $view->layout('components.layouts.guest');
    }
}
