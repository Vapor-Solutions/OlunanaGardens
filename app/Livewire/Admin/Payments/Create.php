<?php

namespace App\Livewire\Admin\Payments;

use App\Models\Booking;
use App\Models\EventType;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Livewire\Component;

class Create extends Component
{
    public $clients;
    public $event_types;
    public $selectedEventType;
    public $selectedClient;
    public $selectedPackage;
    public $selectedPrice;
    public $payment_methods;
    public $reference_code;

    

    protected $listeners = [
        'done' => 'render'
    ];

    // protected $rules = [
    //     'selectedEventType' => 'required',
    //     'selectedClient' => 'required',
    //     'selectedPackage' => 'required',
    //     'selectedPrice' => 'required',
    //     'payment.payment_method_id' => 'required',
    //     'payment.reference_code' => 'required',
    // ];

    public function mount()
    {
        // $this->payment = new Payment();
        $this->clients = collect();
        $this->payment_methods = PaymentMethod::all();
        $this->event_types = EventType::all();
    }

    // public function updatedSelectedEventType($value)
    // {
    //     $event = EventType::find($value);
    //     if ($event) {
    //         $this->clients = $event->bookings()->with('client')->get()->pluck('client');
    //     } else {
    //         $this->clients = collect();
    //     }
    // }




    public function save()
    {
        $this->validate([
            'selectedEventType' => 'required',
            'selectedClient' => 'required',
            'selectedPackage' => 'required',
            'selectedPrice' => 'required',
            'payment_method_id' => 'required',
            'reference_code' => 'required',
        ]);


        $event = EventType::find($this->selectedEventType);
        if ($event) {
            $this->clients = $event->bookings()->with('client')->get()->pluck('client');
        } else {
            $this->clients = collect();
        }


        $booking = Booking::where('event_type_id', $this->selectedEventType)->where('client_id', $this->selectedClient)->first();

        if ($booking) {
            $this->payment->booking_id = $booking->id;
            $this->payment->amount = $this->selectedPrice;
            $this->payment->save();

            $this->emit('done', [
                'success' => "Successfully Made a Payment"
            ]);
        } else {
            $this->emit('done', [
                'error' => "No booking found"
            ]);
        }
    }



    // public function save()
    // {
    //     $this->validate();

    //     $booking = Booking::where('event_type_id', $this->selectedEventType)->where('client_id', $this->selectedClient)->first();

    //     if ($booking) {
    //         $this->payment->booking_id = $booking->id;
    //         $this->payment->amount = $this->selectedPrice;
    //         $this->payment->save();

    //         $this->emit('done', [
    //             'success' => "Successfully Made a Payment"
    //         ]);
    //     } else {
    //         $this->emit('done', [
    //             'error' => "No booking found"
    //         ]);
    //     }
    // }

    public function render()
    {
        return view('livewire.admin.payments.create');
    }
}
