<?php

namespace App\View\Components\Home;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     */
    public string $advice;

    public function __construct()
    {
        $data = json_decode(file_get_contents(storage_path('api/page-data/advices.json')), true);
        $this->advice = $data[array_rand($data)];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.home.header');
    }
}
