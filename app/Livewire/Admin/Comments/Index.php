<?php

namespace App\Livewire\Admin\Comments;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;


    public function approveComment($id)
    {
        $comment = Comment::where('id', $id)->first();
        $comment->is_approved = 1;
        $comment->update();
        $this->dispatch('done', success: 'Successfully Approved a Comment');
    }

    public function rejectComment($id)
    {
        $comment = Comment::where('id', $id)->first();
        $comment->is_approved = 0;
        $comment->update();
        $this->dispatch('done', error: "Comment Not Approved");
    }

    public function render()
    {
        return view('livewire.admin.comments.index', [
            'comments' => Comment::with('client.comment')->paginate(10)
        ]);
    }
}
