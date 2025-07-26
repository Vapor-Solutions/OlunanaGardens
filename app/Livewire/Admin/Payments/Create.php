<?php

namespace App\Livewire\Admin\Payments;

use App\Models\Booking;
use App\Models\EventType;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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
    public $payment_method_id;
    public $reference_code;
    public $phone_number;



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

    private function getAccessToken()
    {
        # Set the API endpoint
        $endpoint = env('MPESA_ENV') == 'sandbox'
            ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate'
            : 'https://api.safaricom.co.ke/oauth/v1/generate';

        # Set the username and password for Basic Auth
        $username = env('MPESA_CONSUMER_KEY');
        $password = env('MPESA_CONSUMER_SECRET');




        # Set the headers for the request
        $headers = [
            'Authorization' => 'Basic ' . base64_encode("$username:$password"),
        ];

        # Set the parameters for the request
        $params = [
            'grant_type' => 'client_credentials',
            'client_credentials' => true,
        ];

        # Make the HTTP request
        $response = Http::withHeaders($headers)->get($endpoint, $params);
        return $response['access_token'];
    }

    public function pushMPESA()
    {

        $this->validate([
            'reference_code' => 'required',
            'phone_number' => 'required|starts_with:254|digits:12',
        ]);

        $booking = Booking::where('booking_ref', $this->reference_code)->first();


        if (!$booking) {
            // Problematic
            $this->dispatch('done', error: "Booking refrence $this->reference_code not found");

            return;
        }

        # STK Simulate
        $timestamp = Carbon::now()->format('YmdHis');
        $password = base64_encode(env('MPESA_SHORTCODE') . env('MPESA_PASSKEY') . $timestamp);

        # stk push data
        $stk_push_data = [
            'BusinessShortCode' => env('MPESA_SHORTCODE'),
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' =>  $booking->getTotalCostAttribute(),
            'PartyA' => "$this->phone_number",
            'PartyB' => env('MPESA_SHORTCODE'),
            'PhoneNumber' => "$this->phone_number",
            'CallBackURL' => env('MPESA_CALLBACK_URL'),
            'AccountReference' => env('APP_NAME'),
            'TransactionDesc' => 'Payment of software license'
        ];

        # stk push url
        $stk_push_url  = env('MPESA_ENV') == 'sandbox'
            ? 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest'
            : 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';


        # send data for processing
        $push_response = $this->mpesaProcessor($stk_push_url, $stk_push_data);

        $decoded_push_response  = json_decode($push_response);
        Log::info('decoded intiate response', [$decoded_push_response]);

        if ($decoded_push_response->ResponseCode == 0) {
            # code...
            // save initiated rrequest to db

            $method = PaymentMethod::where('title', 'mpesa')->first();

            // $toPay = [
            //     'MerchantRequestID' => $decoded_push_response->MerchantRequestID,
            //     'CheckoutRequestID' =>  $decoded_push_response->CheckoutRequestID,
            //     'status' => 'requested',
            //     'resultDesc' => $decoded_push_response->ResponseDescription,
            //     'phoneNumber' => $this->phone_number,
            //     'transactionDate' => Carbon::now()->format('d-m-Y'),
            //     'payment_method_id' => $method->id,
            //     'booking_id' => $booking->id,
            //     'amount' => $booking->getTotalCostAttribute(),
            //     'reference_code' => null,
            // ];
            $payment = new Payment();
            $payment->MerchantRequestID = $decoded_push_response->MerchantRequestID;
            $payment->CheckoutRequestID =  $decoded_push_response->CheckoutRequestID;
            $payment->status = 'requested';
            $payment->resultDesc = $decoded_push_response->ResponseDescription;
            $payment->phoneNumber = $this->phone_number;
            $payment->transactionDate = Carbon::now()->format('Y-m-d');
            $payment->payment_method_id = $method->id;
            $payment->booking_id = $booking->id;
            $payment->amount = $booking->getTotalCostAttribute();
            $payment->reference_code = null;
            $payment->save();
        } else {
            # code...
            // emit something went wrong
        }
    }

    private function mpesaProcessor($stk_push_url, $stk_push_data)
    {
        # send data for processing
        try {
            # Make the HTTP request to MPESA API
            $response = Http::withToken($this->getAccessToken())->post($stk_push_url, $stk_push_data);

            # Log the MPESA request
            Log::info('mpesa:request', [$response]);

            $this->dispatch('done', success : "Check your phone for the mpesa prompt");
        } catch (\Throwable $e) {
            # Handle exceptions
            Log::error('mpesa:error', [$e->getMessage(), $e]);
            $e->getMessage();
        }

        return $response;
    }
}
