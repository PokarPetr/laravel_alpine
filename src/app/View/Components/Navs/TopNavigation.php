<?php

namespace App\View\Components\Navs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopNavigation extends Component
{
    public $user;
    /**
     * Create a new component instance.
     */
    public function __construct($user=null)
    {
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navs.top-navigation');
    }
}
