<?php

namespace App\Livewire\Admin\Bookings;

use App\Models\Booking;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;




    public function render()
    {
        return view('livewire.admin.bookings.index', [
            'bookings' => Booking::orderBy('id', 'desc')->paginate(10)
        ]);
    }
}
