<?php

namespace App\Mail;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingReference extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;// Access booking data 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $companyLogo = storage_path('/public/img/logo.png');
        // $this->attachFromStorage($companyLogo, 'logo.png');
        
        return $this->subject('Customer Booking Details: ' . Carbon::now()->toString())
                    ->view('emails.booking-reference', ['booking' => $this->booking]); // Pass booking data to email view
                    // ->attachFromStorage('public/img/logo.png');
    }
}
