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

class Create extends Component
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

    function save()
    {
        $this->validate();
        if (Carbon::parse($this->booking->start_time)->greaterThanOrEqualTo($this->booking->end_time)) {
            throw ValidationException::withMessages([
                'booking.end_time' => 'The Time Here cannot be before the starting time'
            ]);
        }


        $this->booking->save();

        $this->booking->sections()->attach($this->selectedSections);

        $this->emit('done', [
            'success' => "Successfully Made a Booking"
        ]);
    }

    public function mount()
    {
        $this->clients = Client::all();
        $this->sections = Section::all();
        $this->eventTypes = EventType::all();
        $this->packages = Package::all();
        $this->booking = new Booking();
    }
    public function render()
    {
        $this->booking->price = $this->booking->package?->price;
        return view('livewire.admin.bookings.create');
    }
}
