<?php

namespace App\View\Components\Front;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Rating extends Component
{
    /**
     * Create a new component instance.
     */
    public $count;
    public function __construct($count)
    {
        $this->count = $count;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.rating', [
            'count' => $this->count
        ]);
    }
}
