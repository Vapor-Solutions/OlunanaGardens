<?php

namespace App\Livewire\Admin\Gallery;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $image;
    public $photos;

    public function store()
    {
        $this->validate([
            'image' => 'required|image|max:2048'
        ]);

        $timestamp = Carbon::now()->timestamp;
        $imageName = $timestamp . '.' . $this->image->extension();

        $this->image->storeAs('gallery', $imageName, 'public');

        $this->emit('done', ['success' => 'Successfully Added a New Image']);

        $this->reset();
    }



    public function render()
    {
        return view('livewire.admin.gallery.create');
    }
}
