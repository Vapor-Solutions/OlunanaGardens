<?php

namespace App\Livewire\Front;

use App\Models\Booking;
use App\Models\Client;
use App\Models\EventType;
use Carbon\Carbon;
use Livewire\Component;

class BookingForm extends Component
{

    public $event;

    public $start_time;
    public $email;
    // public $initialBooking = true;
    public $bookingIsAvailable = false;
    public $eventType;


    protected $listeners = [
        'done' => 'render'
    ];

    protected $rules = [
        'event.date' => 'required|after_or_equal:today',
        'event.event_type_id' => 'required',
        'event.adults' => 'required',
        'event.children' => 'required',
        'event.client_name' => 'required',
        'event.email' => 'required|email',
    ];

    protected $messages = [
        'event.date' => ['required' => 'The date is required and should not be in the past'],
        'event.adults' => ['required' => 'The number of adults is required'],
        'event.event_type_id' => ['required' => 'The event type field is mandatory'],
        'event.children' => ['required' => 'The number of children is required'],
        'event.client_name' => ['required' => 'The client\'s name is required'],
        'event.email' => [
            'required' => 'The client\'s email address is required',
            'email' => 'Needs a proper email address format'
        ],
    ];


    public function checkAvailability()
    {

        //validate my inputs
        // $this->validate();
        // dd($this->bookingAvailable() , $this->checkClient());

        if ($this->bookingAvailable() && $this->checkClient()) {
            // proceed with logic to do booking
            // $this->emit('done', ['success' => 'Date available for booking']);


            // $this->initialBooking = true;
            $this->bookingIsAvailable = true;
        } else {
            //else allow user to book
            // $this->initialBooking = true;
            $this->bookingIsAvailable = false;

            // $this->emit('done', ['error' => 'Date is already booked']);
        }
    }


    function bookingAvailable(): bool
    {


        //convert date chosen by user
        $choosenDate = Carbon::parse($this->event['date'])->toDate();
        // dd($choosenDate);
        // dd($this->event['event_type_id']);
        // dd($this->eventType);

        //check if a similar booking of the same date and event is available in the database
        $bookingExists = Booking::where('start_time', $choosenDate)
            ->where('event_type_id', $this->eventType)->first();

        // dd($bookingExists);

        //if booking exists then user cannot be able to book it
        if ($bookingExists) {
            // $this->bookingIs = true;
            return true;
        } else {
            # code...
            return false;
        }
    }



    //if booking process is going on check whether client exists in the database, if he doesnt prompt him to give his/her details

    public function checkClient(): bool
    {
        $client = Client::where('email', $this->event['email']);

        // if return is true proceed with booking
        if ($client->first()) {
            # code...
            return true;
        } else {
            # code...
            // create the client
            
            return true;
        }
    }


    public function render()
    {
        return view('livewire.front.booking-form', [
            'eventTypes' => EventType::all()
        ]);
    }
}
