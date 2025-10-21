<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'payment_method_id',
        'amount',
        'status',
        'reference_code',
        'MerchantRequestID',
        'CheckoutRequestID',
        'ResponseDescription',
        'ResultCode',
        'ResultDesc',
        'mpesa_receipt_number',
        'phone_number',
    ];

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }
    
    public function booking(){
        return $this->belongsTo(Booking::class);
    }
}
