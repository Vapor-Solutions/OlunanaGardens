<?php

namespace App\Livewire\Admin\Payments;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'done' => 'render'
    ];

    public function render()
    {
        return view('livewire.admin.payments.index', [
            'payments' => Payment::with('booking.client')->paginate(10)
        ]);
    }
}
