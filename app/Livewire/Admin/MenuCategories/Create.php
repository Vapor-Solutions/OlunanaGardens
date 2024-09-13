<?php

namespace App\Livewire\Admin\MenuCategories;

use App\Models\MenuCategory;
use Livewire\Component;

class Create extends Component
{
    public MenuCategory $menuCategory;
    public $photo;
    protected $rules = [
        'menuCategory.title' => 'required',
    ];
    function mount()
    {
        $this->menuCategory = new MenuCategory();
    }

    function save()
    {
        $this->validate();
        $this->menuCategory->save();
        $this->reset();
        $this->emit('done', [
            "success" => "Successfully Created this Menu Category"
        ]);
    }
    public function render()
    {
        return view('livewire.admin.menu-categories.create');
    }
}
