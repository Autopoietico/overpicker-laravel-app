<?php

namespace App\View\Components\Home;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{

    public $dates;
    public $copy;
    /**
     * Create a new component instance.
     */
    public function __construct($dates)
    {
        //
        $this->dates = $dates;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.home.footer');
    }
}
