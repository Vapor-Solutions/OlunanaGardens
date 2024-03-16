<?php

namespace App\Livewire\Front;

use Livewire\Component;

class BookingForm extends Component
{

    public $event;


    protected $rules = [
        'event.date' => 'required',
        'event.adults' => 'required',
        'event.children' => 'required',
        'event.client_name' => 'required',
        'event.client_email' => 'required|email',
    ];

    protected $messages = [
        'event.date' => ['required' => 'The date is required'],
        'event.adults' => ['required' => 'The number of adults is required'],
        'event.children' => ['required' => 'The number of children is required'],
        'event.client_name' => ['required' => 'The client\'s name is required'],
        'event.client_email' => [
            'required' => 'The client\'s email address is required',
            'email' => 'Needs a proper email address format'
        ],
    ];


    function checkAvailability()
    {
        $this->validate();

        // dd($this->event);
    }

    public function render()
    {
        return view('livewire.front.booking-form');
    }
}
