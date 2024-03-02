<?php

namespace App\Livewire\Admin\PostCategories;

use App\Models\PostCategory;
use Livewire\Component;

class Create extends Component
{
    public PostCategory $blog_category;

    protected $rules = [
        'blog_category.title' => 'required'
    ];

    public function mount(){
        $this->blog_category = new PostCategory();
    }

    public function save(){
        $this->validate();

        $this->blog_category->save();
        // $this->emit('done', ['success' => "Successfully deleted this Blog Category"]);
        
        return redirect()->route('admin.post-categories.index');

    }

    public function render()
    {
        return view('livewire.admin.post-categories.create');
    }
}
