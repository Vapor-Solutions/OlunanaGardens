<?php

namespace App\Livewire;

use Livewire\Component;

class Restaurant extends Component
{


    public function render()
    {
        return view('livewire.restaurant')->layout('layouts.front');
    }
}
