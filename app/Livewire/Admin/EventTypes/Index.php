<?php

namespace App\Livewire\Admin\EventTypes;

use App\Models\EventType;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.event-types.index',[
            'event_types' => EventType::all()
        ]);
    }
}
