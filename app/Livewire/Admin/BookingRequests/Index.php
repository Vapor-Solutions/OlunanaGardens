<?php

namespace App\Livewire\Admin\BookingRequests;

use App\Models\Booking;
use App\Models\BookingRequest;
use App\Models\Section;
use Livewire\Component;

class Index extends Component
{
    public Booking $booking;
    public $selectedSections;

    function mount() {
        $this->booking = new Booking();
    }

    function makeBooking($request) {
        $this->booking->event_type_id = $request->event_type_id;
        $this->booking->package_id = $request->package_id;
        $this->booking->client_id = $request->client_id;
        $this->booking->start_time = $request->start_time;
        $this->booking->end_time = $request->end_time;
        $this->booking->capacity_adults = $request->capacity_adults;
        $this->booking->capacity_children = $request->capacity_children;
        $this->booking->save();
        $this->booking->sections()->attach($this->selectedSections);

    }
    public function render()
    {
        return view('livewire.admin.booking-requests.index', [
            'bookingRequests' => BookingRequest::orderBy('created_at', 'DESC')->paginate(10),
            'sections'=>Section::all()
        ]);
    }
}
