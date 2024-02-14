<?php

namespace App\Livewire\Admin\Bookings;

use App\Models\Booking;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $checkout_time;

    protected $rules = [
        'checkout_time' => 'required|time'
    ];

    public function render()
    {
        return view('livewire.admin.bookings.index',[
            'bookings' => Booking::orderBy('id', 'desc')->paginate(10)
        ]);
    }

    public function checkout($id)
    {
        $this->validate();

        $booking =  Booking::find($id);
        $booking->check_out = Carbon::parse('Today at ' . $this->checkout_time)->toDateTimeString();
        $booking->save();

        $this->emit('done', 'Successfully Checked out ' . $booking->client->name . 'from Room No.' . $booking->room->room_number);
    }
}
