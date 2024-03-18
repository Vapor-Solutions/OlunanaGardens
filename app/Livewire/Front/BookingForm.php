<?php

namespace App\Livewire\Front;

use App\Models\Booking;
use App\Models\BookingRequest;
use App\Models\Client;
use App\Models\EventType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class BookingForm extends Component
{

    public BookingRequest $bookingRequest;
    public $dateNotAvailable = false;


    protected $listeners = [
        'done' => 'render'
    ];

    protected $rules = [
        'bookingRequest.date' => 'required|after_or_equal:today',
        'bookingRequest.event_type_id' => 'required',
        'bookingRequest.adults' => 'required',
        'bookingRequest.children' => 'required',
        'bookingRequest.client_name' => 'required',
        'bookingRequest.client_email' => 'required|email',
    ];

    protected $messages = [
        'bookingRequest.date' => ['required' => 'The date is required and should not be in the past'],
        'bookingRequest.adults' => ['required' => 'The number of adults is required'],
        'bookingRequest.event_type_id' => ['required' => 'The event type field is mandatory'],
        'bookingRequest.children' => ['required' => 'The number of children is required'],
        'bookingRequest.client_name' => ['required' => 'The client\'s name is required'],
        'bookingRequest.client_email' => [
            'required' => 'The client\'s email address is required',
            'email' => 'Needs a proper email address format'
        ],
    ];


    function checkAvailability()
    {
        //validate my inputs
        $this->validate();

        // Send to Booking Requests
        $this->bookingRequest->save();
        Mail::

    }




    //if booking process is going on check whether client exists in the database, if he doesnt prompt him to give his/her details
    public function checkClient()
    {
        $client = Client::where('email', $this->email)->first();
    }


    public function render()
    {
        return view('livewire.front.booking-form', [
            'eventTypes' => EventType::all()
        ]);
    }
}
