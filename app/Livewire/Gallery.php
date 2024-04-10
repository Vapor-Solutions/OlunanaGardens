<?php

namespace App\Livewire;

use App\Models\EventType;
use App\Models\Gallery as ModelsGallery;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class Gallery extends Component
{
    public $event_types;

    function mount()
    {
        $this->event_types = EventType::all();
    }
    public function render()
    {
        return view('livewire.gallery')->layout('layouts.front');
    }
}
