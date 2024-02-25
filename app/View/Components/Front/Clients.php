<?php

namespace App\View\Components\Front;

use App\Models\Partner;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Clients extends Component
{
    /**
     * Create a new component instance.
     */
    public $partners;
    public function __construct()
    {
        $this->partners = Partner::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.clients',[
            'partners'=>$this->partners
        ]);
    }
}
