<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;

class Images extends Component
{
    use WithFileUploads;
    public $coverImages;
    public $aboutImagePath = 'img/banners/about.jpg';
    public $aboutImage;

    public $galleryImagePath = 'img/banners/gallery.jpg';
    public $galleryImage;
    public $restaurantImagePath = 'img/banners/restaurant.jpg';
    public $restaurantImage;
    public $blogImagePath = 'img/banners/blog.jpg';
    public $blogImage;

    public $faqImagePath = 'img/banners/faq.jpg';
    public $faqImage;
    public $contactUsImagePath = 'img/banners/contact-us.jpg';
    public $contactUsImage;

    public $imageReplacement = [];

    protected $listeners = [
        'done' => '$refresh'
    ];
    public function rules()
    {
        return [
            'imageReplacement.*' => 'required|image|max:2048', // 1MB Max
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

    public function replaceAboutImage()
    {
        $this->validate([
            'aboutImage' => 'required|mimes:jpg|max:2048', // 1MB Max
        ]);

        if ($this->aboutImage) {
            $this->aboutImage->storeAs(path: 'img/banners', name: 'about.jpg', options: 'public');
        }
        $this->aboutImage = null;
        $this->dispatch('done', success: "About image replaced successfully!");
    }


    public function replaceGalleryImage()
    {
        $this->validate([
            'galleryImage' => 'required|mimes:jpg|max:2048', // 1MB Max
        ]);

        if ($this->galleryImage) {
            $this->galleryImage->storeAs(path: 'img/banners', name: 'gallery.jpg', options: 'public');
        }
        $this->galleryImage = null;
        $this->dispatch('done', success: "Gallery image replaced successfully!");
    }

    public function replaceRestaurantImage()
    {
        $this->validate([
            'restaurantImage' => 'required|mimes:jpg|max:2048', // 1MB Max
        ]);

        if ($this->restaurantImage) {
            $this->restaurantImage->storeAs(path: 'img/banners', name: 'restaurant.jpg', options: 'public');
        }
        $this->restaurantImage = null;
        $this->dispatch('done', success: "Restaurant image replaced successfully!");
    }

    public function replaceBlogImage()
    {
        $this->validate([
            'blogImage' => 'required|mimes:jpg|max:2048', // 1MB Max
        ]);

        if ($this->blogImage) {
            $this->blogImage->storeAs(path: 'img/banners', name: 'blog.jpg', options: 'public');
        }
        $this->blogImage = null;
        $this->dispatch('done', success: "Blog image replaced successfully!");
    }

    public function replaceFaqImage()
    {
        $this->validate([
            'faqImage' => 'required|mimes:jpg|max:2048', // 1MB Max
        ]);

        if ($this->faqImage) {
            $this->faqImage->storeAs(path: 'img/banners', name: 'faq.jpg', options: 'public');
        }
        $this->faqImage = null;
        $this->dispatch('done', success: "FAQ image replaced successfully!");
    }

    public function replaceContactUsImage()
    {
        $this->validate([
            'contactUsImage' => 'required|mimes:jpg|max:2048', // 1MB Max
        ]);

        if ($this->contactUsImage) {
            $this->contactUsImage->storeAs(path: 'img/banners', name: 'contact-us.jpg', options: 'public');
        }
        $this->contactUsImage = null;
        $this->dispatch('done', success: "Contact Us image replaced successfully!");
    }

    public function render()
    {
        return view('livewire.admin.images');
    }
}
