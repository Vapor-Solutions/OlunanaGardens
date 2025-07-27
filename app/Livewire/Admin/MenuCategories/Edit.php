<?php

namespace App\Livewire\Admin\MenuCategories;

use App\Models\MenuCategory;
use Livewire\Component;

class Edit extends Component
{
    public MenuCategory $menuCategory;
    public $photo;
    protected $rules = [
        'menuCategory.title' => 'required',
    ];
    protected $listeners = [
        'done' => "mount"
    ];
    function mount($id)
    {
        $this->menuCategory = MenuCategory::find($id);
    }

    public function save()
    {
        $this->validate();
        $this->menuCategory->save();
        $this->dispatch(
            'done',
            success: "Successfully Created this Menu Category"
        );
    }
    public function render()
    {
        return view('livewire.admin.menu-categories.edit');
    }
}
