<?php

namespace App\Livewire\Admin\Packages;

use App\Models\Package;
use Livewire\Component;

class Create extends Component
{
    public Package $package;

    protected $rules = [
        'package.title' => 'required',
        'package.description' => 'required',
        'package.price' => 'required',
    ];

    public function mount()
    {
        $this->package = new Package();
    }

    public function save()
    {
        $this->validate();
        $this->package->save();

        $this->emit('done', ['success' => 'Successfully Added a New Package']);
        // return redirect()->route('admin.packages.index');
        $this->reset();
        $this->package = new Package();
    }

    public function render()
    {
        return view('livewire.admin.packages.create');
    }
}
