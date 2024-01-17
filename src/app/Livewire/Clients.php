<?php

namespace App\Livewire;

use App\Enums\EnumClientTaxType;
use App\Enums\EnumClientType;
use Illuminate\View\View;
use Livewire\Component;

class Clients extends Component
{
    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.clients', [
            'types' => EnumClientType::cases(),
            'taxTypes' => EnumClientTaxType::cases(),
        ]);
    }
}
