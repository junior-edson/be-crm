<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AuthLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        app(config('settings.KT_THEME_BOOTSTRAP.auth'))->init();
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view(config('settings.KT_THEME_LAYOUT_DIR').'._auth');
    }
}
