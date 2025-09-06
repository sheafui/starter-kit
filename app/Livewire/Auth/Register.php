<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Constants;
use App\Livewire\Forms\Auth\RegisterForm;
use App\Support\Toast;
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

        Toast::success("Your account has been created successfully!");

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    public function render()
    {
        /** @var View $view */
        $view = view('livewire.auth.register');

        return $view->layout('components.layouts.guest');
    }
}
