<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class MainLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $pageTitle
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.main-layout');
    }
}
