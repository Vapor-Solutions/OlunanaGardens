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
        'photos' => 'required|array|min:1',
        'photos.*' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
        'event_type_id' => 'required|exists:event_types,id',
        'title' => 'required|string|max:255',
    ];

    public function store()
    {
        $this->validate();

        // Get event type to avoid N+1 query issue
        $eventType = EventType::findOrFail($this->event_type_id);

        foreach ($this->photos as $key => $photo) {
            // Validate allowed extensions explicitly
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            $extension = strtolower($photo->extension());

            if (!in_array($extension, $allowedExtensions)) {
                throw ValidationException::withMessages([
                    'photos.' . $key => 'Invalid file type. Only JPEG, PNG, and WebP images are allowed.'
                ]);
            }

            $gallery = new Gallery();
            $gallery->event_type_id = $this->event_type_id;
            $gallery->title = $this->title;

            // Use random filename for security
            $imageName = Str::random(40) . '.' . $extension;
            $photo->storeAs('gallery/' . Str::slug($eventType->title), $imageName, 'public');
            $gallery->image_path = 'gallery/' . Str::slug($eventType->title) . '/' . $imageName;
            $gallery->save();
        }

        $this->dispatch('done', success: 'Successfully Added ' . count($this->photos) . ' Image(s)');
        $this->reset();
    }







    public function render()
    {
        return view('livewire.admin.gallery.create', [
            'event_types' => EventType::all()
        ]);
    }
}
