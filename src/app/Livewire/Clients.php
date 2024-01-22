<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Clients extends Component
{
    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.clients.clients');
    }
}
