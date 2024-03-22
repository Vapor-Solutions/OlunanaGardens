<?php

namespace App\Livewire\Front;

use App\Models\Booking;
use App\Models\Client;
use App\Models\EventType;
use App\Models\Package;
use App\Models\Section;
use Carbon\Carbon;
use Livewire\Component;

class BookingForm extends Component
{
    public $event;
    public $bookingIsAvailable = false;
    public $noBooking = "james";

    protected $rules = [
        'event.start_time' => 'required|after_or_equal:today',
        'event.end_time' => 'required',
        'event.event_type_id' => 'required',
        'event.package_id' => 'required',
        'event.adults' => 'required',
        'event.children' => 'required',
        'event.name' => 'required',
        'event.address' => 'required',
        'event.phone_number' => 'required',
        'event.email' => 'required|email',
        'event.price' => 'required',
        'event.section' => 'required'
    ];

    protected $messages = [
        'event.start_time.required' => 'The start date and time is required and should not be in the past',
        'event.end_time.required' => 'The end date and time is required',
        'event.event_type_id.required' => 'The event type field is mandatory',
        'event.package_id.required' => 'The package type is mandatory',
        'event.section.required' => 'The package type is mandatory',
        'event.adults.required' => 'The number of adults is required',
        'event.children.required' => 'The number of children is required',
        'event.price.required' => 'The price field is required',
        'event.name.required' => 'The client\'s name is required',
        'event.address.required' => 'The client\'s address is required',
        'event.phone_number.required' => 'The client\'s phone number is required',
        'event.email.required' => 'The client\'s email address is required',
        'event.email.email' => 'The client\'s email must be a valid email address',
    ];

    public function checkAvailability()
    {
        $this->bookingIsAvailable = $this->bookingAvailable();
        $this->bookingIsAvailable == true ? $this->noBooking = "true":$this->noBooking = "false";

       
      
    }


 

    public function book(){
        $booking = new Booking();
        $booking->start_time = $this->event['start_time'];
        $booking->end_time = $this->event['end_time'];
        $booking->event_type_id = $this->event['event_type_id'];
        $booking->package_id = $this->event['package_id'];
        $booking->capacity_adults = $this->event['adults'];
        $booking->capacity_children = $this->event['children'];
        $booking->price = $this->event['price'];

        $client = Client::where('email', $this->event['email']);

        if (!$client) {
            $newClient = new Client();
            $newClient->name = $this->event['name'];
            $newClient->email = $this->event['email'];
            $newClient->phone_number = $this->event['phone_number'];
            $newClient->address = $this->event['address'];
            $newClient->save();
        }

        $booking->client_id = $client->id;
        $booking->save();

    }

    public function bookingAvailable(): bool
    {
       
        $eventType = EventType::find($this->event['event_type_id']);
        // $section = Section::find($this->event['section']);
        $section = 

        // dd($section);

        $choosenDateStartTime = date_format(Carbon::parse($this->event['start_time']),"Y-m-d H:i:s");
        $choosenDateEndTime = date_format(Carbon::parse($this->event['end_time']),"Y-m-d H:i:s");

        // dd($choosenDateStartTime , $choosenDateEndTime);

        $bookingExists = Booking::
            whereBetween('start_time', [
                $choosenDateStartTime,
                $choosenDateEndTime])
            ->where('event_type_id', $eventType->id)
            ->where('section', $section)
            ->first();
        dd($bookingExists);

        
        return $bookingExists ? true : false;
    }

    // public function checkClient(): bool
    // {
    //     $client = Client::where('email', $this->event['email'])->first();

    //     if ($client) {
    //         return true;
    //     } else {
    //         $newClient = new Client();
    //         $newClient->name = $this->event['name'];
    //         $newClient->email = $this->event['email'];
    //         $newClient->phone_number = $this->event['phone_number'];
    //         $newClient->address = $this->event['address'];
    //         $newClient->save();

    //         return true;
    //     }
    // }

    public function render()
    {
        return view('livewire.front.booking-form', [
            'eventTypes' => EventType::all(),
            'packageTypes' => Package::all(),
            'sections' => Section::all(),
        ]);
    }
}
