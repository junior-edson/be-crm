<?php

namespace App\Livewire;

use App\Enums\EnumClientTaxType;
use App\Enums\EnumClientType;
use Illuminate\View\View;
use Livewire\Component;

class ClientsList extends Component
{
    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.clients.list', [
            'types' => EnumClientType::cases(),
            'taxTypes' => EnumClientTaxType::cases(),
        ]);
    }
}
