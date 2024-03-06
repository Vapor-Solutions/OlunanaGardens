<?php

namespace App\Livewire\Front;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Livewire\Component;

class RestaurantMenu extends Component
{
    public $menuCategories, $menuItems, $active = 1;

    function activate($id)
    {
        $this->active = $id;
    }

    public function __construct()
    {
        $this->menuCategories = MenuCategory::all();
        $this->menuItems = MenuItem::all();
        $this->active = MenuCategory::first()->id ?? 1;
    }

    public function render()
    {
        return view('livewire.front.restaurant-menu', [
            'menuCategories' => $this->menuCategories,
            'menuItems' => $this->menuItems,
        ]);
    }
}
