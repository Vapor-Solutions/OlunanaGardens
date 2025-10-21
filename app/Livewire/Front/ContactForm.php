<?php

namespace App\Livewire\Front;

use App\Mail\SupportRequest;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public $name, $email, $phone, $subject, $body;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email:rfc,dns|max:255',
        'phone' => 'required|string|regex:/^[\d\s\-\+\(\)]+$/|max:20',
        'subject' => 'required|string|max:255',
        'body' => 'required|string|max:5000',
    ];

    protected $messages = [
        'name.required' => 'Please provide your name',
        'name.max' => 'Name cannot exceed 255 characters',
        'email.required' => 'Please provide your email address',
        'email.email' => 'Please provide a valid email address',
        'email.max' => 'Email cannot exceed 255 characters',
        'phone.required' => 'Please provide your phone number',
        'phone.regex' => 'Please provide a valid phone number',
        'phone.max' => 'Phone number cannot exceed 20 characters',
        'subject.required' => 'Please provide a subject',
        'subject.max' => 'Subject cannot exceed 255 characters',
        'body.required' => 'Please provide a message',
        'body.max' => 'Message cannot exceed 5000 characters',
    ];
    public function send()
    {
        $this->validate();

        Mail::to(env('COMPANY_EMAIL'))->send(new SupportRequest($this->name, $this->email, $this->phone, $this->subject, $this->body));

        $this->dispatch(
            'done',
            success: "Successfully submitted your Support Request"
        );

        $this->reset();
    }
    public function render()
    {
        return view('livewire.front.contact-form');
    }
}
