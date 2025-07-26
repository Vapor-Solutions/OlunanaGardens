<?php

namespace App\Livewire\Admin\PostCategories;

use App\Models\PostCategory;
use Livewire\Component;
use Psy\CodeCleaner\FunctionContextPass;

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
        $this->dispatch('done', success:"Successfully Created a New Blog Category");
        $this->resetInput();

        // return redirect()->route('admin.post-categories.index');

    }

    public function resetInput(){
        $this->blog_category = new PostCategory();
    }

    public function render()
    {
        return view('livewire.admin.post-categories.create');
    }
}
