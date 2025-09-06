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


        session()->flash('notify', [
            'content' => "Your account has been created successfully!",
            'type' => 'success'
        ]);
        
        $this->redirectIntended(default: '/');

    }

    public function render()
    {
                /** @var View $view */
        $view = view('livewire.auth.register');

        return $view->layout('components.layouts.app');
    }
}
