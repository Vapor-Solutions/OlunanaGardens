<?php

namespace App\Livewire\Admin\Menus;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public MenuItem $menuItem;
    public $photo;
    public $previousUrl;
    public $menuCategories;

    protected $rules = [
        'menuItem.menu_category_id' => 'required',
        'menuItem.title' => 'required',
        'menuItem.description' => 'nullable',
        'menuItem.price' => 'required',
        'photo' => 'nullable|image|max:5120',
    ];
    protected $listeners = [
        'done' => "mount"
    ];
    public function mount($id)
    {
        $this->menuCategories = MenuCategory::all();
        $this->menuItem = MenuItem::find($id);
        $this->previousUrl = URL::previous();
    }

    public function save()
    {
        $this->validate();

        if ($this->photo) {
            $fileName = Str::slug($this->menuItem->title . '-' . now()->format('YmdHis')) . '.' . $this->photo->extension();
            $this->photo->storeAs('menu_items', $fileName, 'public');
            $this->menuItem->image_path = 'menu_items/' . $fileName;
        }

        $this->menuItem->update();
        $this->dispatch('done', success: "Successfully Updated this Menu Item");
        return redirect($this->previousUrl);
    }
    public function render()
    {
        return view('livewire.admin.menus.edit');
    }
}
