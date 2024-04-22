<?php

namespace App\Livewire\Admin\EventTypes;

use App\Models\EventType;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
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


    public function mount()
    {
        $this->event_type = new EventType();
    }

    public function save()
    {
        $this->validate();

        $this->event_type->save();
        if ($this->thumbnail) {
            $image_path = 'event_types/' . $this->event_type->id . $this->thumbnail->extension();
            $this->thumbnail->store($image_path, 'public');
            $this->event_type->image_path = $image_path;
        }
        $this->event_type->update();
        $this->emit('done', ['success' => "Successfully Added a New Event Type"]);
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->event_type = new EventType();
    }

    public function render()
    {
        return view('livewire.admin.event-types.create');
    }
}
