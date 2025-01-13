<?php

namespace App\Livewire\Admin\Menus;

use App\Models\MenuItem;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public MenuItem $menuItem;
    public $photo;
    protected $rules = [
        'menuItem.menu_category_id' => 'required',
        'menuItem.title' => 'required|unique:menu_items,title',
        'menuItem.description' => 'nullable',
        'menuItem.price' => 'required',
        'photo' => 'nullable|image|max:5120',
    ];
    function mount()
    {
        $this->menuItem = new MenuItem();
    }
    protected $listeners = [
        'done' => "mount"
    ];

    function save()
    {
        $this->validate();

        if ($this->photo) {
            $fileName = Str::slug($this->menuItem->title . '-' . now()->format('YmdHis')) . '.' . $this->photo->extension();
            $this->photo->storeAs('menu_items', $fileName, 'public');
            $this->menuItem->image_path = 'menu_items/' . $fileName;
        }
        $this->menuItem->save();
        // $this->reset();
        $this->emit('done', [
            "success" => "Successfully Created this Menu Item"
        ]);
        $this->menuItem = new MenuItem();
    }
    public function render()
    {
        return view('livewire.admin.menus.create');
    }
}
