<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;

class Images extends Component
{
    use WithFileUploads;
    public $coverImages;
    public $imageReplacement = [];

    protected $listeners = [
        'done' => '$refresh'
    ];
    public function rules()
    {
        return [
            'imageReplacement.*' => 'required|image|max:1024', // 1MB Max
        ];
    }
    public function mount()
    {
        $this->coverImages = [
            'img/slider/1.jpg',
            'img/slider/2.jpg',
            'img/slider/3.jpg',
        ];
    }

    public function replaceImage($index)
    {
        $this->validate();

        if ($this->imageReplacement[$index]) {
            $this->imageReplacement[$index]->storeAs(path: 'img/slider', name: ($index + 1) . ".jpg", options: 'public');
        }
        $this->imageReplacement[$index] = null;
        $this->dispatch('done', success: "Image replaced successfully!");
    }

    public function render()
    {
        return view('livewire.admin.images');
    }
}
