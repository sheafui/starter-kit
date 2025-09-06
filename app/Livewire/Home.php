<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Component\View;

class Home extends Component
{
    public function render()
    {
        /** @var View $view */
        $view = view('home');

        return $view->layout('components.layouts.guest');
    }
}
