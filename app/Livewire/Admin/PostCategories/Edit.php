<?php

namespace App\Livewire\Admin\PostCategories;

use App\Models\PostCategory;
use Livewire\Component;

class Edit extends Component
{
    public PostCategory $post_category;

    protected $rules = [
        'post_category.title' => 'required'
    ];

    public function mount($id)
    {
        $this->post_category = PostCategory::find($id);
    }

    public function save()
    {
        $this->validate();
        $this->post_category->save();

        $this->dispatch('done', success: "Successfully Edited this Blog Category");
        return redirect()->route('admin.post-categories.index');
    }

    public function render()
    {
        return view('livewire.admin.post-categories.edit');
    }
}
