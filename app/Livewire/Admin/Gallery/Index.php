<?php

namespace App\Livewire\Admin\Gallery;

// use Faker\Core\File;

use App\Models\Gallery;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    // public $photos = [];

    protected $listeners = [
        'done' => 'mount'
    ];



    function deletePhoto($photo_id)
    {
        $photo = Gallery::find($photo_id);
        if ($photo && file_exists(public_path($photo->image_path))) {
            unlink(public_path($photo->image_path));
        }
        $photo->delete();

        $this->dispatch(
            'done',
            success: "Successfully Deleted the Photo"
        );
    }

    public function render()
    {
        return view('livewire.admin.gallery.index', [
            'photos' => Gallery::orderBy('created_at', 'DESC')->get(),
        ]);
    }
}
