<?php

namespace App\Livewire\Admin\Gallery;

// use Faker\Core\File;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $photos = [];

    protected $listeners = [
        'done' => 'mount'
    ];

    public function mount()
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

    function deletePhoto($index)
    {
        if (file_exists(public_path('gallery/' . $this->photos[$index]))) {
            unlink(public_path('gallery/' . $this->photos[$index]));
            $this->emit('done', [
                'success' => "Successfully Deleted the Photo"
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.gallery.index', [
            // 'photos' => $this->photos->paginate(10),
        ]);
    }
}
