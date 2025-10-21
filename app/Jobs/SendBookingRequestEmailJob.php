<?php

namespace App\Jobs;

use App\Mail\BookingRequest;
use App\Mail\BookingRequestTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendBookingRequestEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $bookingRequest;
    public $client;

    public $tries = 3;

    public $retryAfter = 60;

    public function __construct($bookingRequest, $client)
    {
        $this->bookingRequest = $bookingRequest;
        $this->client = $client;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->client->email)->send(new BookingRequestTicket($this->bookingRequest));
        Mail::to(env('COMPANY_EMAIL'))->send(new BookingRequest($this->bookingRequest));
    }
}
