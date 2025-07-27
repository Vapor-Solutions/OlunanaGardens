<?php

namespace App\Livewire\Admin\Bookings;

use App\Models\Booking;
use App\Models\Client;
use App\Models\EventType;
use App\Models\Package;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Edit extends Component
{
    public $clients;
    public $eventTypes;
    public $packages;
    public $sections;
    public $selectedSections = [];
    public Booking $booking;

    protected $rules = [
        'booking.event_type_id' => 'required',
        'booking.package_id' => 'required',
        'booking.client_id' => 'required',
        'booking.start_time' => 'required',
        'booking.end_time' => 'required',
        'booking.capacity_adults' => 'required',
        'booking.capacity_children' => 'required',
        'booking.price' => 'required',
        'selectedSections' => 'required',
    ];

    protected $listeners = [
        'done' => 'render'
    ];

    public function save()
    {
        $this->validate();
        if (Carbon::parse($this->booking->start_time)->greaterThanOrEqualTo($this->booking->end_time)) {
            throw ValidationException::withMessages([
                'booking.end_time' => 'The Time Here cannot be before the starting time'
            ]);
        }
        $this->booking->sections()->detach();


        $this->booking->update();

        $this->booking->sections()->attach($this->selectedSections);

        return redirect()->route('admin.bookings.index');
    }

    public function mount($id)
    {
        $this->clients = Client::all();
        $this->sections = Section::all();
        $this->eventTypes = EventType::all();
        $this->packages = Package::all();
        $this->booking = Booking::find($id);
        foreach ($this->booking->sections as $key => $section) {
            array_push($this->selectedSections, $section->id);
        }
    }
    public function render()
    {
        if (Booking::find($this->booking->id)->package_id != $this->booking->package_id) {
            $this->booking->price = $this->booking->package?->price;
        }
        return view('livewire.admin.bookings.edit');
    }
}
