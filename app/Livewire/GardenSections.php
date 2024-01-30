<?php

namespace App\Livewire;

use Livewire\Component;

class GardenSections extends Component
{
    public function render()
    {
        return view('livewire.garden-sections')->layout('layouts.front');
    }
}
