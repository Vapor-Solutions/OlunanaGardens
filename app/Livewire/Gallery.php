<?php

namespace App\Livewire;

use App\Models\EventType;
use App\Models\Gallery as ModelsGallery;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class Gallery extends Component
{

    public function render()
    {
        return view('livewire.gallery', [
            'event_types'=> EventType::all(),
            'galleries'=>ModelsGallery::all()
        ])->layout('layouts.front');
    }
}
