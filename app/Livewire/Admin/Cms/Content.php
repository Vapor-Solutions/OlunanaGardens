<?php

namespace App\Livewire\Admin\Cms;

use Livewire\Component;

class Content extends Component
{
    public $about_content1;
    public $contact_us_content;
    public $footer_content;
    public $home_content;
    public $restaurant_content;
    public $speciality_content;

    function mount()
    {
        $this->about_content1 = file_get_contents('text/about_content1.txt');
        $this->contact_us_content = file_get_contents('text/contact_us_content.txt');
        $this->footer_content = file_get_contents('text/footer_content.txt');
        $this->home_content = file_get_contents('text/home_content.txt');
        $this->restaurant_content = file_get_contents('text/restaurant_content.txt');
        $this->speciality_content = file_get_contents('text/speciality_content.txt');
    }

    public function save_about_content1()
    {
        file_put_contents('text/about_content1.txt', $this->about_content1);

        $this->dispatch(
            'done',
            success: "Successfully Saved 'About' Content"
        );
    }
    public function save_contact_us_content()
    {
        file_put_contents('text/contact_us_content.txt', $this->contact_us_content);

        $this->dispatch(
            'done',
            success: "Successfully Saved 'Contact Us' Content"
        );
    }
    public function save_footer_content()
    {
        file_put_contents('text/footer_content.txt', $this->footer_content);

        $this->dispatch(
            'done',
            success: "Successfully Saved 'Footer' Content"
        );
    }
    public function save_home_content()
    {
        file_put_contents('text/home_content.txt', $this->home_content);

        $this->dispatch(
            'done',
            success: "Successfully Saved 'Home' Content"
        );
    }
    public function save_restaurant_content()
    {
        file_put_contents('text/restaurant_content.txt', $this->restaurant_content);

        $this->dispatch(
            'done',
            success: "Successfully Saved 'Restaurant' Content"
        );
    }
    public function save_speciality_content()
    {
        file_put_contents('text/speciality_content.txt', $this->speciality_content);

        $this->dispatch(
            'done',
            success: "Successfully Saved 'Speciality' Content"
        );
    }
    public function render()
    {
        return view('livewire.admin.cms.content');
    }
}
