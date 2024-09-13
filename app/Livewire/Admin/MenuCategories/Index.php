<?php

namespace App\Livewire\Admin\MenuCategories;

use App\Models\MenuCategory;
use Livewire\Component;

class Index extends Component
{
    public $menuCategories = [];

    function mount()
    {
        $this->menuCategories = MenuCategory::all();
    }
    public function render()
    {
        return view('livewire.admin.menu-categories.index');
    }
}
