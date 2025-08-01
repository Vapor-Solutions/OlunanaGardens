<?php

namespace App\Livewire\Admin\Cms;

use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Faq extends Component
{
    use WithPagination, WithoutUrlPagination;


    public function delete($id){
         Question::find($id)->delete();

        $this->dispatch('done', success: "Successfully Deleted The Question and Answer");
    }
    public function render()
    {
        return view('livewire.admin.cms.faq', [
            'questions' => Question::paginate(10)
        ]);
    }
}
