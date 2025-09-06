<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        /** @var View $view */
        $view = view('livewire.dashboard');

        return $view->layout('components.layouts.dashboard');
    }
}
