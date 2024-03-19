<?php

namespace App\Livewire\Front;

use App\Jobs\SendBookingRequestEmailJob;
use App\Models\Booking;
use App\Models\BookingRequest;
use App\Models\Client;
use App\Models\EventType;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class BookingForm extends Component
{

    public BookingRequest $bookingRequest;
    public Client $client;
    public $dateNotAvailable = false;
    public $client_name, $client_email, $client_phone_number;


    protected $listeners = [
        'done' => 'mount'
    ];

    protected $rules = [
        'bookingRequest.start_time' => 'required|after_or_equal:today',
        'bookingRequest.event_type_id' => 'required',
        'bookingRequest.package_id' => 'required',
        'bookingRequest.capacity_adults' => 'required',
        'bookingRequest.capacity_children' => 'required',
        'client_name' => 'required',
        'client_email' => 'required|email',
        'client_phone_number' => 'required',
    ];

    protected $messages = [
        'bookingRequest.date' => ['required' => 'The date is required and should not be in the past'],
        'bookingRequest.capacity_adults' => ['required' => 'The number of adults is required'],
        'bookingRequest.event_type_id' => ['required' => 'The event type field is mandatory'],
        'bookingRequest.package_id' => ['required' => 'The menu package field is mandatory'],
        'bookingRequest.capacity_children' => ['required' => 'The number of children is required'],
        'client_name' => ['required' => 'The client\'s name is required'],
        'client_phone_number' => ['required' => 'The client\'s Phone Number is required'],
        'client_email' => [
            'required' => 'The client\'s email address is required',
            'email' => 'Needs a proper email address format'
        ],
    ];

    function mount()
    {
        $this->bookingRequest = new BookingRequest();
    }


    function checkAvailability()
    {
        //validate my inputs
        $this->validate();
        $this->checkClient();

        $this->bookingRequest->client_id = $this->client->id;

        // Send to Booking Requests
        $this->bookingRequest->save();
        SendBookingRequestEmailJob::dispatch($this->bookingRequest);

        // $this->reset();

        $this->emit('done', [
            'success' => 'Successfully Sent Your Booking Request. You shall be contacted Shortly'
        ]);
    }




    //if booking process is going on check whether client exists in the database, if he doesnt prompt him to give his/her details
    public function checkClient()
    {
        $clientExists = Client::where('email', $this->client_email)->exists();
        if ($clientExists) {
            $this->client = Client::where('email', $this->client_email)->first();
        } else {
            $client = new Client();
            $client->name = $this->client_name;
            $client->email = $this->client_email;
            $client->phone_number = $this->client_phone_number;
            $client->save();

            $this->client = $client;
        }
    }


    public function render()
    {
        return view('livewire.front.booking-form', [
            'eventTypes' => EventType::all(),
            'packages' => Package::all(),
        ]);
    }
}
