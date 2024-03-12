<?php

namespace App\Livewire\Admin\Cms;

use Carbon\Carbon;
// use Faker\Core\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Livewire\Component;
use Livewire\WithFileUploads;

class Photos extends Component
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

        // Storage::disk('local')->putFileAs('admin/gallery', $this->image, $imageName);
        $this->image->storeAs('gallery', $imageName, 'public');

        $this->emit('done', ['success' => 'successfully added a new image']);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.cms.photos');
    }
}
