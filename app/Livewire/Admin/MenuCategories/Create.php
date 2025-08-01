<?php

namespace App\Livewire\Admin\MenuCategories;

use App\Models\MenuCategory;
use Livewire\Component;

class Create extends Component
{
    public MenuCategory $menuCategory;
    public $photo;
    protected $rules = [
        'menuCategory.title' => 'required|unique:menu_categories,title',
    ];

    // protected $listeners = [
    //     'done' => 'mount'
    // ];
    function mount()
    {
        $this->menuCategory = new MenuCategory();
    }

    public function save()
    {
        $this->validate();
        $this->menuCategory->save();
        $this->dispatch(
            'done',
            success: "Successfully Created this Menu Category"
        );
        $this->menuCategory = new MenuCategory();
    }
    public function render()
    {
        return view('livewire.admin.menu-categories.create');
    }
}
