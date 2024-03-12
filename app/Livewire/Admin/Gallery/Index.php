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
    public $photos;

    public function mount()
    {
        $this->photos = collect(File::allFiles(public_path('gallery')));
    }

    public function render()
    {
        return view('livewire.admin.gallery.index', [
            // 'photos' => $this->photos->paginate(10),
        ]);
    }
}
