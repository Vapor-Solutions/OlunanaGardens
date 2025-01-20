<?php

namespace App\View\Components\Front;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RestaurantMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public $menuCategories;
    public function __construct()
    {
        $this->menuCategories = MenuCategory::with('menuItems')->get();
        // $this->menuItems = MenuItem::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.restaurant-menu');
    }
}
