<?php

namespace App\Livewire\Admin\EventTypes;

use App\Models\EventType;
use Livewire\Component;

class Edit extends Component
{
    public EventType $event_type;

    protected $rules =[
        'event_type.title' => 'required'
    ];

    public function mount($id){
        $this->event_type = EventType::find($id);
    }

    public function save(){
        $this->validate();
        $this->event_type->save();
        return redirect()->route('admin.event-types.index');
    }

    public function render()
    {
        return view('livewire.admin.event-types.edit');
    }
}
