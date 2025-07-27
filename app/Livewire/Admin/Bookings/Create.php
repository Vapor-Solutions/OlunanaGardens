<?php

namespace App\Livewire\Admin\Bookings;

use App\Mail\BookingReference;
use App\Models\Booking;
use App\Models\Client;
use App\Models\EventType;
use App\Models\Package;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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

    public function save()
    {
        $this->validate();

        do {
            $bookingRef = strtoupper(Str::random(5));
        } while (Booking::where('booking_ref', $bookingRef)->exists());



        if (Carbon::parse($this->booking->start_time)->greaterThanOrEqualTo($this->booking->end_time)) {
            throw ValidationException::withMessages([
                'booking.end_time' => 'The Time Here cannot be before the starting time'
            ]);
        }

        $this->booking->booking_ref = $bookingRef;
        $this->booking->save();

        //sending a mail containing the booking details to the client

        Mail::to($this->booking->client->email)->send(new BookingReference($this->booking));

        $this->booking->sections()->attach($this->selectedSections);

        $this->dispatch(
            'done',
            success: "Successfully Made a Booking"
        );

        $this->resetInput();
    }

    function resetInput()
    {
        $this->booking = new Booking();
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
