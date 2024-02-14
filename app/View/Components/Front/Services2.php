<?php

namespace App\View\Components\Front;

use App\Models\EventType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Services2 extends Component
{
    /**
     * Create a new component instance.
     */
    public $eventTypes;

    public function __construct()
    {
        $this->eventTypes = EventType::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.services2',[
            'eventTypes'=>$this->eventTypes
        ]);
    }
}
