<?php

namespace App\Livewire\Admin\Gallery;

// use Faker\Core\File;

use App\Models\Gallery;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    // public $photos = [];

    protected $listeners = [
        'done' => 'mount'
    ];



    function deletePhoto($photo_id)
    {
        $photo = Gallery::find($photo_id);
        if (file_exists(public_path($photo->image_path))) {
            unlink(public_path($photo->image_path));
        }
        $photo->delete();

        $this->emit('done', [
            'success' => "Successfully Deleted the Photo"
        ]);
    }

    public function render()
    {
        return view('livewire.admin.gallery.index', [
            'photos' => Gallery::orderBy('created_at','DESC')->get(),
        ]);
    }
}
