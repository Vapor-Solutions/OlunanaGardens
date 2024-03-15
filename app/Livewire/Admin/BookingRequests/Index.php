<?php

namespace App\Livewire\Admin\BookingRequests;

use App\Models\BookingRequest;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.booking-requests.index', [
            'bookingRequests' => BookingRequest::orderBy('created_at', 'DESC')->paginate(10)
        ]);
    }
}
