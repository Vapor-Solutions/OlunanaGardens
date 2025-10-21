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

    public ?BookingRequest $bookingRequest = null;
    public ?Client $client = null;
    public ?bool $dateNotAvailable = false;
    public ?string $client_name = '';
    public ?string $client_email = '';
    public ?string $client_phone_number = '';
    public ?string $client_country = '';


    protected $listeners = [
        'done' => 'mount'
    ];

    protected $rules = [
        'bookingRequest.start_time' => 'required|after_or_equal:today',
        'bookingRequest.event_type_id' => 'required',
        'bookingRequest.package_id' => 'required',
        'bookingRequest.capacity_adults' => 'required|integer|min:1',
        'bookingRequest.capacity_children' => 'required|integer|min:0',
        'client_name' => 'required|string|min:3',
        'client_email' => 'required|email',
        'client_phone_number' => 'required|string|min:7',
        'client_country' => 'required|string|min:2',
    ];

    protected $validationAttributes = [
        'bookingRequest.start_time' => 'event date and time',
        'bookingRequest.event_type_id' => 'event type',
        'bookingRequest.package_id' => 'menu package',
        'bookingRequest.capacity_adults' => 'number of adults',
        'bookingRequest.capacity_children' => 'number of children',
        'client_name' => 'full name',
        'client_email' => 'email address',
        'client_phone_number' => 'phone number',
        'client_country' => 'country',
    ];

    protected $messages = [
        'bookingRequest.date' => ['required' => 'The date is required and should not be in the past'],
        'bookingRequest.capacity_adults' => ['required' => 'The number of adults is required'],
        'bookingRequest.event_type_id' => ['required' => 'The event type field is mandatory'],
        'bookingRequest.package_id' => ['required' => 'The menu package field is mandatory'],
        'bookingRequest.capacity_children' => ['required' => 'The number of children is required'],
        'client_name' => ['required' => 'The client\'s name is required'],
        'client_phone_number' => ['required' => 'The client\'s Phone Number is required'],
        'client_country' => ['required' => 'The client\'s Country is required'],
        'client_email' => [
            'required' => 'The client\'s email address is required',
            'email' => 'Needs a proper email address format'
        ],
    ];

    function mount()
    {
        $this->bookingRequest = new BookingRequest();
    }

    /**
     * Real-time validation on property update
     */
    public function updated($propertyName)
    {
        // Validate only the property that changed
        $this->validateOnly($propertyName);
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

        $this->dispatch('done', succes:'Successfully Sent Your Booking Request. You shall be contacted Shortly'
        );
    }



    // public function checkClient(): bool
    // {
    //     $client = Client::where('email', $this->event['email'])->first();

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
            $client->country = $this->client_country;
            $client->save();

            $this->client = $client;
        }
    }

    //         return true;
    //     }
    // }

    public function render()
    {
        return view('livewire.front.booking-form', [
            'eventTypes' => EventType::all(),
            'packages' => Package::all(),
        ]);
    }
}
