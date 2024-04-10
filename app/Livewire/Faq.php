<?php

namespace App\Livewire;

use App\Models\Question;
use Livewire\Component;

class Faq extends Component
{
    public function render()
    {
        return view('livewire.faq', [
            'questions'=>Question::all(),
        ])->layout('layouts.front');
    }
}
