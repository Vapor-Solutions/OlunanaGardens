<?php

namespace App\Livewire;

use App\Models\Testimonial;
use Livewire\Component;

class About extends Component
{
    public function render()
    {
        return view('livewire.about',[
            'testimonials'=>Testimonial::all()
        ])->layout('layouts.front');
    }
}
