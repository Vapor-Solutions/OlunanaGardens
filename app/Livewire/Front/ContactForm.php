<?php

namespace App\Livewire\Front;

use App\Mail\SupportRequest;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public $name, $email, $phone, $subject, $body;

    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'subject' => 'required',
        'body' => 'required',
    ];
    protected $messages = [
        'name.required'=>'This field is required',
        'email.required'=>'This field is required',
        'phone.required'=>'This field is required',
        'subject.required'=>'This field is required',
        'body.required'=>'This field is required',
    ];
    public function send()
    {
        $this->validate();

        Mail::to(env('COMPANY_EMAIL'))->send(new SupportRequest($this->name, $this->email, $this->phone, $this->subject, $this->body));

        $this->emit('done', [
            'success'=>"Successfully submitted your Support Request"
        ]);

        $this->reset();

    }
    public function render()
    {
        return view('livewire.front.contact-form');
    }
}
