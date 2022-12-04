<?php

namespace App\Http\Livewire\Admin;

use App\Models\Comment;
use App\Models\Sample;
use Livewire\Component;

class SampleListComment extends Component
{
    public $delete_id;
    public $sample_id;
    protected $queryString =['sample_id'];

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteComment'
    ];

    public function deleteComment()
    {

        try {
            $comment = Comment::findOrFail($this->delete_id);
            if($comment->delete()){
                $this->dispatchBrowserEvent('show-delete-success');
            }
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
    }

    public function CommentConfirm($article)
    {
        $comment = Comment::findOrFail($article);
        try {
            if ($comment->approved == 0) {
                $comment->approved = 1;
            } elseif ($comment->approved == 1) {
                $comment->approved = 0;
            }
            $comment->save();
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error');
        }
    }
    public function render()
    {
        return view('livewire.admin.sample-list-comment')
            ->extends('dash.include.master')
            ->section('dash_main_content')
            ->with(['sample'=> Sample::findOrFail($this->sample_id)]);
    }
}
