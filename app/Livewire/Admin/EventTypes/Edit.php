<?php

namespace App\Livewire\Admin\EventTypes;

use App\Models\EventType;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public EventType $event_type;
    public $thumbnail;

    protected $rules = [
        'event_type.title' => 'required',
        'event_type.price' => 'required',
        'event_type.description' => 'nullable',
        'thumbnail' => 'nullable|image|dimensions:ratio=7/4',
    ];

    public function mount($id)
    {
        $this->event_type = EventType::find($id);
    }

    public function save()
    {
        $this->validate();
        if ($this->thumbnail) {
            $image_path = 'event_types/' . $this->event_type->id .'.'. $this->thumbnail->extension();
            $this->thumbnail->storeAs('event_types/',$this->event_type->id .'.'. $this->thumbnail->extension(), 'public');
            $this->event_type->image_path = $image_path;
        }
        $this->event_type->update();
        return redirect()->route('admin.event-types.index');
    }

    public function render()
    {
        return view('livewire.admin.event-types.edit');
    }
}
