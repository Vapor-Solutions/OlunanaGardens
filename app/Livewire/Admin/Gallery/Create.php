<?php

namespace App\Livewire\Admin\Gallery;

use App\Models\EventType;
use App\Models\Gallery;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $photos = [];
    public $event_type_id;
    public $title;

    protected $rules = [
        'photos.*' => 'image|max:2048',
        'event_type_id' => 'required',
        'title' => 'required',
    ];

    public function store()
    {
        $this->validate();


        if (count($this->photos) > 0) {
            foreach ($this->photos as $key => $photo) {
                $gallery = new Gallery();
                $gallery->event_type_id = $this->event_type_id;
                $gallery->title = $this->title;
                $timestamp = Carbon::now()->timestamp;
                $imageName = Str::slug($this->title) . '-' . $key . '-' . $timestamp . '.' . $photo->extension();
                $photo->storeAs('gallery/' . $gallery->eventType->title, $imageName, 'public');
                $gallery->image_path = 'gallery/' . $gallery->eventType->title . '/' . $imageName;
                $gallery->save();
            }
            $this->dispatch('done', success: 'Successfully Added New Image(s)');
            $this->reset();
        } else {
            throw ValidationException::withMessages([
                'photos' => "You need to upload atleast One Photo"
            ]);
        }
    }







    public function render()
    {
        return view('livewire.admin.gallery.create', [
            'event_types' => EventType::all()
        ]);
    }
}
