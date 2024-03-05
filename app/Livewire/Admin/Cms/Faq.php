<?php

namespace App\Livewire\Admin\Cms;

use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;

class Faq extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function delete($id){
         Question::find($id)->delete();

        $this->emit('done', ['success' => "Successfully Deleted The Question and Answer"]);
    }
    public function render()
    {
        return view('livewire.admin.cms.faq', [
            'questions' => Question::paginate(10)
        ]);
    }
}
