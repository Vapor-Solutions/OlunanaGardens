<?php

namespace App\Livewire;

use App\Models\Gallery as ModelsGallery;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class Gallery extends Component
{
    public $photos = [];

    function mount()
    {
        // Get the path to the public/gallery folder
        $galleryPath = public_path('gallery');

        // Get all the files in the gallery folder
        $files = File::files($galleryPath);

        // Loop through the files and add their paths to the $photoPaths array
        foreach ($files as $file) {
            array_push($this->photos, $file->getFilename());
        }
    }
    public function render()
    {

        return view('livewire.gallery')->layout('layouts.front');
    }
}
